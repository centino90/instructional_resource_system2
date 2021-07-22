<?php

namespace App\Services\MarkupServices;
use Illuminate\Http\Request;

class MarkupService
{
    public $listGroupActions = [];

    public function store($name)
    {
        if(!is_array($name)) {
            $this->listGroupActions = array_merge(
                $this->listGroupActions, 
                [
                    $name => [
                        'modalTitle' => $name,
                        'href' => '#' . $name,
                        'img' => asset('assets/svg-'.$name.'.svg')
                    ]
                ]
            );

            return;
        }
       
        foreach ($name as $value) {
            $this->listGroupActions = array_merge(
                $this->listGroupActions, 
                [
                    $value => [
                        'modalTitle' => $value,
                        'href' => '#' . $value,
                        'img' => asset('assets/svg-'.$value.'.svg')
                    ]
                ]
            );
        }
    }

    public function show()
    {
        $listGroupActionsMarkup = '';
        foreach ($this->listGroupActions as $navPill => $value) {
      
            $listGroupActionsMarkup .= '<div class="col col-4 list-group-item-action" data-toggle="list" href="'.$value['href'].'" role="tab" modal-title="'.$value['modalTitle'].'">
                                            <img src="'.$value['img'].'" alt="'.$value['modalTitle'].'"
                                                class="img-fluid rounded mx-auto d-block">
                                            <span class="position-absolute">'.$value['modalTitle'].'</span>
                                        </div>';

       
        }

        return $listGroupActionsMarkup;
    }
}