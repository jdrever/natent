<?php

class AreasPage extends Kirby\Cms\Page
{
    public function children()
    {
        $areas = [];

        foreach (Db::select('cc_areas') as $area)
        {
            $content = [
                'id' => $area->id(),
                'title'    => $area->name() ?? 'New area',
            ];
            $contentEn = [
                
                'description' => $area->description(),
            ];
            if ($areaDe=Db::first('cc_areas_translations', '*', 'area_id='.$area->id().' and language_code="de"'))
            {
                $contentDe = [
                    'description' => $areaDe->description(),
                ];
            }

            
            $areas[] = [
                'template' => 'area',
                'slug' => Str::slug($area->name()),
                'model'    => 'area',  
                'num' =>   $area->id(),      
                'content' => array_merge($content, $contentEn),
                'translations' => [ 
                    'en' =>
                    [
                        'code' => 'en',
                        //this is where I should be using the translated content from the database above, I can't even pass in hard-coded values
                        'content' => ['description'=>'en-test', ]                   
                    ],
                    'de' =>
                    [
                        'code' => 'de',
                        //this is where I should be using the translated content from the database above, I can't even pass in hard-coded values
                        'content' => ['description'=>'de-test', 'translatedTitle'=>'hi',],
                    ],
                ]
            ];
        }

        return Pages::factory($areas, $this);
    }
}
