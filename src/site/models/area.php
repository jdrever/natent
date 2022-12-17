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
            if (isset($data['title'])) unset($data['title']);
            if (isset($data['id'])) unset($data['id']);
            if (isset($data['uuid'])) unset($data['uuid']);

            if ($languageCode=='en')
            {
                return Db::update('cc_areas', $data, ['id' => $this->content()->id()]);
            }
            $description=$data['description'];
            unset($data['description']);
            Db::update('cc_areas', $data, ['id' => $this->content()->id()]);
            if ($translatedArea = Db::first('cc_areas_translations', '*', ['id' => $this->content()->id()])) 
            {
                return Db::update('cc_areas_translations', ['area_id'=>$this->content()->id(),'description'=>$description, 'language_code'=>$languageCode ], ['id' => $this->content()->id()]);
            }
            else
            {
                return Db::insert('cc_areas_translations', ['area_id'=>$this->content()->id(),'description'=>$description, 'language_code'=>$languageCode ] );
            }
            
        } 
        else
        {
            //TODO: not ideal to hardcode the default language
            if ($languageCode=='en')
            {
                return Db::insert('cc_areas', ['name'=>$data['title']] );
            }
            else
            {
                Db::insert('cc_areas', ['name'=>$data['title']] );
                return Db::insert('cc_areas_translations', ['description'=>$data['description'], 'language_code'=>$languageCode ] );

            }
            
        }
        return true;

    }
    public function delete(bool $force = false): bool
    {
        return Db::delete('cc_areas', ['id' => $this->content()->id()]);
    }


}