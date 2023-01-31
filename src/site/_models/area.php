<?php

class AreaPage extends Kirby\Cms\Page
{

    public function changeTitle(string $title, string $languageCode = null)
    {

        if ($country = Db::first('cc_areas', '*', ['id' => $this->id()])) {
            if (Db::update('cc_areas', ['name' => $title], ['id' => $this->id()])) {
                return $this;
            };
        }
        return $this;
    }

    public function writeContent(array $data, string $languageCode = null): bool
    {
        if ($area = Db::first('cc_areas', '*', ['id' => $this->content()->id()])) 
        {
            if (isset($data['uuid'])) unset($data['uuid']);

            if ($languageCode=='en')
            {
                return Db::update('cc_areas', $data, ['id' => $this->content()->id()]);
            }
            Db::update('cc_areas', $data, ['id' => $this->content()->id()]);
            if ($translatedArea = Db::first('cc_areas_translations', '*', ['id' => $this->content()->id(),'language_code'=>$languageCode])) 
            {
                return Db::update('cc_areas_translations', $data, ['area_id' => $this->content()->id(), 'language_code'=>$languageCode]);
            }
            else
            {
                echo("doing insert");
                echo(var_dump($data));
                echo('area_id:'.$this->content()->id());
                echo('translated_title:'.$data['translated_title']);
                Db::insert('cc_areas_translations', ['area_id'=>$this->content()->id(),'translated_title'=>$data['translated_title'], 'description'=>$data['description'], 'language_code'=>$languageCode ] );
                echo('done');
            }
            
        } 
        else
        {
            //TODO: not ideal to hardcode the default language
            if ($languageCode==='en')
            {
                return Db::insert('cc_areas', ['id'=>$data['id']] );
            }
            else
            {
                return Db::insert('cc_areas_translations', ['description'=>$data['description'], 'translated_title'=>$data['translated_title'], 'language_code'=>$languageCode ] );

            }
            
        }
        return true;
    }

    public function delete(bool $force = false): bool
    {
        return Db::delete('cc_areas', ['id' => $this->content()->id()]);
    }


}