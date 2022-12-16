<?php

class AreasPage extends Kirby\Cms\Page
{
    public function children()
    {
        $areas = [];

        foreach (Db::select('cc_areas') as $area)
        {
            $areas[] = [
                'template' => 'area',
                'slug' => Str::slug($area->name()),
                'model'    => 'area',  
                'num' =>   $area->id(),      
                'content' => [
                    'areaId' => $area->id(),
                    'title'    => $area->name() ?? 'New area',
                    'description' => $area->description(),
                ]
            ];
        }

        return Pages::factory($areas, $this);
    }
}
