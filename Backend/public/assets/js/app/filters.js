api.categories={
    getCategories : async (route, params)=>{
        const result = await fetch(baseUrl + route, {
            method: 'GET',
            data: params,
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded', 
            },
        });
        const data = await result.json();
        return data;
    },
}
html.categories={
    resetCheckBoxes: ()=>{
        var checkBoxes = DOMelements.filters.querySelectorAll("input[type=checkbox]");
        for (let i=0; i<checkBoxes.length;i++){
            checkBoxes[i].checked = false;
        }
    },
    resetColors:()=>{
        let list = document.querySelector(".filter-colors").children 
        for (let i=0; i<list.length;i++){
            if (list[i].classList.contains("selected")){
                list[i].classList.remove("selected")
            }
        }
    },
    resetPriceSlider:()=>{
        DOMelements.priceSlider.noUiSlider.set([0,300])
    },
    showPriceSlider: () =>
    { 
        if (DOMelements.filters !== null)
        DOMelements.filters.innerHTML+= 
            "<div class='widget widget-collapsible'>\
                <h3 class='widget-title'>\
                    <a data-toggle='collapse' href='#widget_price' role='button' aria-expanded='true' aria-controls='widget-price'> Price </a>\
                </h3>\
                <div class='collapse show' id='widget_price'>\
                    <div class='widget-body'>\
                        <div class='filter-price'>\
                            <div class='filter-price-text'> Price Range:\
                                <span id='filter-price-range'></span>\
                            </div>\
                            <div class='slider' id='price_slider'></div>\
                        </div>\
                    </div>\
                </div>\
                </div>";
        DOMelements.priceSlider = document.getElementById('price_slider');
        DOMelements.priceRange = document.getElementById('filter-price-range');
    },
    checkBox:(array, filterName)=>{
        let filter ="<div class='filter-items'>";
        for (let i =0; i<array.length; i++){
            filter +=
            "<div class='filter-item'>\
                <div class='custom-control custom-checkbox'>\
                    <input type='checkbox' class='custom-control-input filters-input' name ='"+array[i]+"'id='"+filterName+"-"+i+"'>\
                    <label class='custom-control-label' for='"+filterName+"-"+i+"'>" +array[i] + "</label>\
                </div>\
                \
            </div>"
        }
        filter+="</div>"
        return filter;
    },
    colorBox:(array)=>{
        let filter ="<div class='filter-colors'>";
        //class = "selected" pour couleur selectionné
        for (let i=0; i<array.length;i++){
            filter+=
            "<a class='colors' style='background:"+ array[i]+"'><span class='sr-only'></span></a>"
        }
        filter+="</div>"
        return filter;
    },
    showCollapsible:(filterName, array)=>{
        widget = filterName === "color" ? html.categories.colorBox(array,filterName):
                                html.categories.checkBox(array,filterName);
            DOMelements.filters.innerHTML+= 
                "<div class='widget widget-collapsible'>\
                    <h3 class='widget-title'>\
                        <a data-toggle='collapse' href='#widget-"+filterName+"' role='button' aria-expanded='true' aria-controls='widget-"+filterName+"'>"+
                        helpers.capitalizeFirstLetter(filterName)+
                        "</a>\
                    </h3>\
                    <div class='collapse show' id='widget-"+filterName+"'>\
                        <div class='widget-body'>" +
                            widget +
                        "</div>\
                    </div>\
                </div>";
    },
    showFiltersCleaner:()=>{
        if (DOMelements.filters !== null)
        DOMelements.filters.innerHTML+=  
            "<div class='widget widget-clean'>\
                <label><i class='icon-close'></i>Filters</label>\
                <a type='button' class='sidebar-filter-clear filtersCleaner'>Clean All</a>\
            </div>"
    },

}
main.categories={
    resetFilters:()=>{
        html.categories.resetCheckBoxes();
        html.categories.resetColors();
        html.categories.resetPriceSlider();
    },
    colorBox:(array)=>{
        html.categories.showCollapsible("color",  array);
        document.addEventListener('click', async e=>{
            if (e.target && e.target.matches(".colors")){
                //then change css
                if (!e.target.classList.contains("selected"))
                    e.target.classList.add("selected");
                else 
                    e.target.classList.remove("selected");
                //update data
                let params = main.categories.postParams();
                main.items.items(params);
            };
        });
    },
    filters:async()=>{
        let filters = await api.categories.getCategories('/api/v1/categories');
        html.categories.showFiltersCleaner();
        html.categories.showCollapsible("category", filters.categories)
        //html.categories.showCollapsible("brand", filters.brands)
        main.categories.colorBox(filters.colors);
        html.categories.showCollapsible("size",  filters.sizes)
        main.categories.priceSlider();
    },
    priceSlider: ()=>{
        html.categories.showPriceSlider('priceName');
        noUiSlider.create(DOMelements.priceSlider, {
            start: [ 0, 300 ],
            connect: true,
            step: 20,
            margin: 60,
            range: {
                'min': 0,
                'max': 1000
            },
            tooltips: true,
            format: wNumb({
                decimals: 0,
            })
        });
    //adding action to the slider
        DOMelements.priceSlider.noUiSlider.on('change', async function( values, handle ){
            DOMelements.priceRange.textContent = values.join(' - ');
            let params = main.categories.postParams();
            main.items.items(params);
        });
    },
    //sert a généré un url de paramètres 
    uriParams:()=>{
        let params=[];
        //chekboxes data
        var checkBoxes = DOMelements.filters.querySelectorAll("input[type=checkbox]");
        for (let i = 0; i<checkBoxes.length;i++){
            if (checkBoxes[i].checked){
                let filterName = checkBoxes[i].id.replace(/-|\d/g, '');
                Object.keys(params).includes(filterName)?
                params[filterName] += ',' +checkBoxes[i].name:
                params[filterName] = checkBoxes[i].name;
            } 
        }
        //colors data
        let list = document.querySelector(".filter-colors").children 
        for (let i=0; i<list.length;i++){
            if (list[i].classList.contains("selected")){
                Object.keys(params).includes("clr")?
                params["clr"] += ',' +list[i].style.background:
                params["clr"] = list[i].style.background;
            }
        };
        //price data
        params.mn = DOMelements.priceSlider.noUiSlider.get()[0];
        params.mx = DOMelements.priceSlider.noUiSlider.get()[1];

        return helpers.encode(params);
    },
    //sert de postuler directement les données dans un post
    postParams:()=>{
        let params= new Object;
        //chekboxes data
        var checkBoxes = DOMelements.filters.querySelectorAll("input[type=checkbox]");
        for (let i = 0; i<checkBoxes.length;i++){
            if (checkBoxes[i].checked){
                let filterName = checkBoxes[i].id.replace(/-|\d/g, '');
                //si la liste n'existe pas on la créé
                if (typeof params[filterName] == "undefined")
                    params[filterName] = [];
                params[filterName].push(checkBoxes[i].name)
            } 
        }
        //colors data
        let list = document.querySelector(".filter-colors").children 
        for (let i=0; i<list.length;i++){
            if (list[i].classList.contains("selected")){
                if (typeof params['color'] == "undefined")
                    params['color'] = [];
                params['color'].push(list[i].style.background)
            }
        };
        //price data
        params.min = DOMelements.priceSlider.noUiSlider.get()[0];
        params.max = DOMelements.priceSlider.noUiSlider.get()[1];

        return params;
    }
}

buttons.categories={
    filters : document.addEventListener('click', async e=>{
        if (e.target && e.target.matches(".filters-input")){
            let params = main.categories.postParams();
            main.items.items(params);
        }
    }),
    filtersCleaner :  document.addEventListener('click', async e=>{
        if (e.target && e.target.matches(".filtersCleaner")){
                main.categories.resetFilters();
                main.items.items();
            };
    }),
}

window.onload = main.categories.filters(); //afficher les filters dispnible : boutton couleur et price sont inclus
buttons.categories.filters; //activer le boutton de filtration
buttons.categories.filtersCleaner; //activer le boutton cleaner



