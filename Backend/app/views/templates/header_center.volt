<div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
    <form action="#" method="get">
        <div class="header-search-wrapper search-wrapper-wide">
            <div class="select-custom">
                <select id="cat" name="cat">
                    <option value="">All Departments</option>
                    {% for department in departments%}
                        <option value="">{{department}}</option>
                    {% endfor %}
                </select>
            </div><!-- End .select-custom -->
            <label for="q" class="sr-only">Search</label>
            <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </div><!-- End .header-search-wrapper -->
    </form>
</div><!-- End .header-search -->