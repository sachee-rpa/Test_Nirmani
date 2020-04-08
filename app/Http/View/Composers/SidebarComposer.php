<?php

namespace App\Http\View\Composers;

use Illuminate\Http\Request;
use Illuminate\View\View;


class SidebarComposer  
{
    protected $route;
    protected $navData;

    public function __construct(Request $request)
    {        
        $this->route = $request->route()->getName();
        $this->navData = $this->createNav();
    }
 
    private function createNav()
    {
        $permissions =  config('permissions.data');
        if (!empty($permissions)) {
         
        
            foreach ( $permissions  as $key => $permission) {
                              
                $permissions[$key]['active'] = false;        
                if (!empty($permission['subs'])){
                    $mainCats = $permission['subs'];   
                    $permissions[$key]['subs']['active'] = false;   
                    foreach ($mainCats as $mainCatKey => $mainCat) {           
                         $permissions[$key]['subs'][$mainCatKey]['active'] = false;                          
                        if (
                         isset($mainCat['route_name'])
                         &&  $mainCat['route_name'] == $this->route
                         ) {
                            $permissions[$key]['subs'][$mainCatKey]['active'] = true;
                            $permissions[$key]['active'] = true;  
                            $permissions[$key]['subs']['active'] = true;      
                         }                        
                         if (!empty($mainCat['subs'])) {
                             $subCats = $mainCat['subs'];                                
                            foreach ($subCats  as $subCats_key => $subCat) {
                                $permissions[$key]['subs'][$mainCatKey]['subs'][$subCats_key]['active'] = false;
                                if (
                                    isset($subCat['route_name'])
                                    &&  $subCat['route_name'] == $this->route
                                    ) {
                                         $permissions[$key]['active'] = true;  
                                         $permissions[$key]['subs'][$mainCatKey]['active'] = true;
                                         $permissions[$key]['subs']['active'] = true;     
                                         $permissions[$key]['subs'][$mainCatKey]['subs'][$subCats_key]['active'] = true;
                                    }                        
                               }
                           }
                    }  
                }
               
            }

        }
    
        return $permissions;      
    }

    public function compose(View $view)
    {
        $view->with([             
            'sidebars'=>$this->navData,
            ]);
    }
}
