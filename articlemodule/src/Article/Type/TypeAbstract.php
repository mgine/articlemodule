<?php

namespace Article\Type;

use Article\Entity\CmsNewsEntity;
use Article\Form\ArticleSearchFormAbstract;

abstract class TypeAbstract extends CmsNewsEntity {

    protected $displayMode = '';

    protected $technicalContentPrepared = false;

    public abstract function url(): string;

    public abstract function getSearchLinker() : ArticleSearchFormAbstract;

    /**
     * @param array $params
     * @return string
     */
    public function listItemHtml(array $params): string{

        return $this->getServiceLocator()
            ->get('viewhelpermanager')
            ->get('partial')->__invoke('article/index/list/item'.$this->displayMode.'.phtml', ['pg' => $this, 'params' => $params]);
    }

    public function calculateDisplayMode(){

        if($this->getTags()->hasTag('typ_youtube_video') and !empty($this->getIdYoutubeVideo())){
            $this->displayMode = 'video';
            return;
        }elseif($this->getTags()->hasTag('typ_vimeo_video') and !empty($this->getAmpContent())){
            $this->displayMode = 'vimeo';
            return;
        }elseif($this->getTags()->hasTag('typ_galeria') and !empty($this->getIdGallery()) and $this->getGalleryActive()){
            $this->displayMode = 'gallery';
            return;
        }elseif($this->getTags()->hasTag('typ_standard') and !empty($this->getShortContent())){
            return;
        }

        if(!empty($this->getIdYoutubeVideo())){
           $this->displayMode = 'video';
            return;
        }elseif(!empty($this->getAmpContent())){
            $this->displayMode = 'vimeo';
            return;
        }elseif(!empty($this->getIdGallery()) and $this->getGalleryActive()){
            $this->displayMode = 'gallery';
            return;
        }

        return;

    }

    /**
     * @return string
     */
    public function getDisplayMode(): string{
        return $this->displayMode;
    }

    /**
     * @return array
     */
    public function getFirstLevelCategorySearchLinks(): array
    {
        $ret = [];

        foreach($this->getFirstLevelCategory() as $category){
            $ret[] = [
                'name' => $category->getName(),
                'link' => $this->getSearchLinker()->prepareLinkToCateogory($category)
            ];
        }
        return $ret;
    }

    /**
     * @return string
     */
    public function getTechnicalContent(): string
    {
        if($this->technicalContentPrepared){
            return parent::getTechnicalContent();
        }

        $this->technical_content = $this->prepareTechnicalContent();
        $this->technicalContentPrepared = true;

        return parent::getTechnicalContent();
    }

    /**
     * @return string
     */
    public function prepareTechnicalContent() : string
    {

        $content = (string) parent::getTechnicalContent();
        $tags = $this->getTags();
        $search = [];
        $replace = [];

        foreach($tags->getGroupSlugs() as $slug){
            $search[] = '{tag:'.$slug.'}';
            $imploded = [];
            foreach($tags->getTagsFromGroup($slug) as $tag){
                if($this->getSearchLinker()->searchParamIsAviable($slug)){
                    $imploded[] = '<a class="blue-link" href="'.$this->getSearchLinker()->prepareLinkWithData([$slug=>$tag->slug], false).'" >'.$tag->nazwa.'</a>';
                }else{
                    $imploded[] = $tag->nazwa;
                }
            }

            $replace[] = implode(', ', $imploded);
        }

        $content =  str_replace($search, $replace, $content);
        $content = preg_replace('/{tag:[a-zA-Z-!}]+}/', '', $content);

        return $content;
    }
}
