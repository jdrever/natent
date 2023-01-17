<?php

class AreasPage extends Kirby\Cms\Page
{
    public function children()
    {
        $areas = [];
        //TODO: don't hardcode the languages
        foreach (Db::select('cc_areas') as $area)
        {
            $content = [
                'id' => $area->id(),
                'title'    => $area->name() ?? 'New area',
            ];
            $contentEn = [
                
                'description' => $area->description(),
                'translated_title' => $area->title(),
            ];
            $contentDe=[];
            $contentNl=[];
            if ($areaDe=Db::first('cc_areas_translations', '*', 'area_id='.$area->id().' and language_code="de"'))
            {
                $contentDe = [
                    'translated_title' => $areaDe->translated_title(),
                    'description' => $areaDe->description(),
                ];
            }
            if ($areaNl=Db::first('cc_areas_translations', '*', 'area_id='.$area->id().' and language_code="nl"'))
            {
                $contentNl = [
                    'translated_title' => $areaNl->translated_title(),
                    'description' => $areaNl->description(),
                ];
            }

            
            $areas[] = [
                'template' => 'area',
                'slug' => Str::slug($area->name()),
                'model'    => 'area',  
                'num' =>   $area->id(),      
                'translations' => [ 
                    'en' =>
                    [
                        'code' => 'en',
                        'content' => array_merge($content, $contentEn)                   
                    ],
                    'de' =>
                    [
                        'code' => 'de',
                        'content' => array_merge($content, $contentDe) ,
                    ],
                    'nl' =>
                    [
                        'code' => 'nl',
                        'content' => array_merge($content, $contentNl) ,
                    ],
                ]
            ];
        }

        return Pages::factory($areas, $this);
    }
}
