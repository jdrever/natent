<?php

class challengesPage extends Kirby\Cms\Page
{
    public function children()
    {
        $challenges = [];

        foreach (Db::select('cc_challenges') as $challenge)
        {
            $challenges[] = [
                'template' => 'challenge',
                'slug' => Str::slug($challenge->name()),
                'model'    => 'challenge',  
                'num' =>   $challenge->id(),      
                'content' => [
                    'id' => $challenge->id(),
                    'title'    => $challenge->name() ?? 'New challenge',
                    'description' => $challenge->description(),
                    'further_information' => $challenge->further_information(),  
                    'area_id' => strval($challenge->area_id()),
                    'area_id2' => strval($challenge->area_id2()),
                    'area_id3' => strval($challenge->area_id3()),   
                    'country_id' =>   strval($challenge->country_id()),         
                ]
            ];
        }
        //echo(var_dump($challenges));

        return Pages::factory($challenges, $this);
    }
}
