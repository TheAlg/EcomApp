<?php 

namespace Base\Plugins;


 

class Views extends \Base\App\ControllerBase
{
    protected $standardSubCategories = ['All','New', 
    'Featured', 'Best Seller'];
    protected $subCategories;
    protected $div;

    public function bannerTitle(string $title): string {
        $array = explode(' ', $title);
        if (sizeof($array) > 2 ){
            array_splice($array, 2, 0, '<br>');
            $newString = implode(' ',$array);
            return $newString;
        }
       return $title;
    }
    public function bannerOldPrice($oldPrice = null): string {
        if (empty($oldPrice))
           return  '<sup class="font-weight-light">from</sup>';
        else
            return  '<sup class="font-weight-light line-through">$'. $oldPrice . '</sup>';
    }
    public function bannerNewPrice(string $newPrice): string {
        $array = explode('.', $newPrice);
        if (sizeof($array) > 1){
            return $array[0] . '<sup>,' . $array[1] .'</sup>';
        }
        else 
            return $newPrice;
    }
    public function link(string $suff, $id){
        return str_replace(' ', '_', $suff) . '-' . str_replace(' ', '_', $id) . '-link';
    }
    public function tab(string $suff, $id){
        return str_replace(' ', '_', $suff) . '-' . str_replace(' ', '_', $id) . '-tab';
    }
    public function oldPrice($id){
        $product =  $this->products->set(['product_id' => $id])->oldPrice();
        if ($product !== null)
            return $product->price;
        return null;
    }
    public function subCategories(string $val =null, array $array = null){
        if (isset($val) && $val === 'Hot Deals Products') 
            return $array;
        else 
            return $this->standardSubCategories;
    }
    public function date($date){
        $date = date_diff(new \DateTime("now"), date_create($date))->format('%R%a');
        return \str_replace('+', '', $date);
    }
    public function push($target, array $array){
        array_unshift($array, $target);
        return $array;
    }
    public function class($tab){
        if ($tab === 'All'){
            return 'nav-link active';
        }
        else 
            return 'nav-link';
    }
    public function selected($tab){
        if ($tab === 'All'){
            return 'true';
        }
        else 
            return 'false';
    }
    public function showActive($tab){
        if ($tab === 'All'){
            return 'tab-pane p-0 fade show active';
        }
        else 
            return 'tab-pane p-0 fade';
    }
    public function div(string $category = null ){
        if ($category === 'Hot Deals Products'){
            $this->div = 1;
            return '<div class="bg-light pt-3 pb-5">';
        }
        else 
            return '';
    }
    public function closediv(){
        if ($this->div === 1){
            $this->div=0;
            return '</div>';
        }
        else 
            return '';
    }
    public function dateFormat($year, $month){
        if (strlen($month) == 1)
        $month = '0'.$month;
        return $year.'-'.$month;
    }
    public function radioCheck($param1, $param2, $id){
        $html = '<input type="radio" id="'.$id .'" name="shipping" class="custom-control-input"';
        $html .= $param1 === $param2 ? 'checked>': '>';
        return $html;
    }
}	
