<?php

namespace Article\Form;

use Article\Entity\CmsNewsCategoryListEntity;
use Article\Search\Filter\CategorySlug;
use Article\Search\Filter\TagSlug;
use Article\Search\Filter\Text;
use Article\Search\Filter\Typ;
use Zend\InputFilter\InputFilter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

abstract class ArticleSearchFormAbstract extends \Zend\Form\Form implements ServiceLocatorAwareInterface
{

    protected $serviceLocator;

    protected $type;

    protected $mainCategory;

    protected $linkData;

    protected $subjects;

    protected $tagsElements = [];

    protected $queryParams = [
        'text'
    ];

    protected $linkParamsInOrder;

    protected $queryParamsArray;

    protected $queryParamsString;

    public static $linkPrefix;

    protected static $collator;

    protected $categorySlug = CategorySlug::INPUT_NAME;


    public function __construct()
    {
        parent::__construct('project-search-form');
    }

    /**
     * @return ArticleSearchFormAbstract
     */
    public function prepareFormElements(): ArticleSearchFormAbstract{

        $this->add([
            'name' => CategorySlug::INPUT_NAME,
            'attributes' => [
                'type' => 'select'
            ],
        ]);

        $this->add([
            'name' => Text::INPUT_NAME,
            'attributes' => [
                'type' => 'text'
            ],
        ]);
        foreach($this->tagsElements as $element){
            $this->add([
                'name' => $element['slug'],
                'class' => $element['slug'],
                'attributes' => [
                    'type' => 'select'
                ]
            ]);
        }

        return $this;
    }

    /**
     * @return InputFilter
     */
    public function prepareFilter(): InputFilter{

        $filter = new InputFilter();

        $value_options = [];
        foreach($this->mainCategory->getCategoryAndChildSlugs() as $slug){
            $value_options[] = $slug;
        }

        $filter->add([
            'name' =>  $this->categorySlug,
            'required' => false,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
                ['name' => 'HtmlEntities'],
            ],
            'validators' => [
                [
                    'name' => 'InArray',
                    'options' => [
                        'haystack' => $value_options
                    ]
                ]
            ]
        ]);

        $filter->add([
            'name' =>  Text::INPUT_NAME,
            'required' => false,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
            ]
        ]);

        foreach($this->tagsElements as $element) {
            $value_options = [];
            foreach ($element['elements'] as $option) {
                $value_options[] = $option->slug;
            }
            $filter->add([
                'name' => $element['slug'],
                'required' => false,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                    ['name' => 'HtmlEntities'],
                ],
                'validators' => [
                    [
                        'name' => 'InArray',
                        'options' => [
                            'haystack' => $value_options
                        ]
                    ]
                ]
            ]);
        }

        return $filter;

    }

    /**
     * @param int $flag
     * @return array|object
     */
    public function getData($flag = \Zend\Form\FormInterface::VALUES_NORMALIZED) {

        $data = parent::getData($flag);
        $data[Typ::INPUT_NAME] = $this->type;
        foreach($this->tagsElements as $element) {
            if (isset($data[$element['slug']])) {

                if(empty($data[TagSlug::INPUT_NAME])){
                    $data[TagSlug::INPUT_NAME] = [];
                }
                $data[TagSlug::INPUT_NAME][] = $data[$element['slug']];
                unset($data[$element['slug']]);
            }
        }

        return $data;

    }

    /**
     * @return array|null
     */
    protected function getSelectedCategory(): ?array{

        if($this->get($this->categorySlug)->getValue()){
            $selectedCategory = $this->getServiceLocator()->get('Categories')->getCategoryBySlug($this->get($this->categorySlug)->getValue());
            return [
                'name' => $selectedCategory->getName(),
                'link' => $this->prepareLinkWithoutParam($this->categorySlug)
            ];
        }

        return null;

    }

    /**
     * @param string $slug
     * @return array|null
     */
    public function getSelectedBySlug(string $slug): ?array{

        if($slug == $this->categorySlug){
            return $this->getSelectedCategory();
        }

        $element = false;
        foreach($this->tagsElements as $el){
            if($el['slug'] == $slug){
                $element = $el;
            }
        }
        if(!$element){
            return null;
        }

        if($this->get($slug)->getValue()){
            $selected = $element['elements'][$this->get($slug)->getValue()];
            return  [
                'name' => $selected->nazwa,
                'link' => $this->prepareLinkWithoutParam($slug)
            ];
        }

        return null;
    }

    /**
     * @return array
     */
    public function prepareCategoryList(): array{

        $ret = [];

        foreach($this->mainCategory->childRecursive() as $category){
            $ret[] = [
                'name' => mb_convert_case($category->getName().' '.($category->getAssignedNews() ? '('.$category->getAssignedNews().')' : ''), MB_CASE_TITLE, 'UTF-8'),
                'link' => $this->prepareLinkWithAdditionalParam($this->categorySlug, $category->getSlug())
            ];
        }

        usort($ret, function($a, $b)
        {
            $x = ArticleSearchFormAbstract::getCollator()->compare($a['name'], $b['name']);
            if ($x == 0) {
                return 0;
            }
            return ($x < 0) ? -1 : 1;
        });

        return $ret;
    }

    /**
     * @return \Collator
     */
    public static function getCollator(): \Collator{
        if(self::$collator != NULL){
            return self::$collator;
        }
        return self::$collator = new  \Collator('pl_PL');
    }

    /**
     * @param string $slug
     * @return array
     */
    public function prepareListBySlug(string $slug): array{

        if($slug == $this->categorySlug){
            return $this->prepareCategoryList();
        }

        $element = false;
        foreach($this->tagsElements as $el){
            if($el['slug'] == $slug){
                $element = $el;
            }
        }
        if(!$element){
            return [];
        }
        $ret = [];

        foreach($element['elements'] as $subject){
            $ret[] = [
                'name' => $subject->nazwa,
                'link' => $this->prepareLinkWithAdditionalParam($slug, $subject->slug)
            ];
        }
        return $ret;
    }

    /**
     * @param CmsNewsCategoryListEntity $category
     * @return string
     */
    public function prepareChildCategoryList(CmsNewsCategoryListEntity $category): string{

        $ret = '<li>'.'<a href="'.$this->prepareLinkWithAdditionalParam($this->categorySlug, $category->getSlug()).'" >'.$category->getName().'</a>';

        if($category->child()){
            foreach($category->child() as $childCategory){
                $ret .= '<ul>';
                $ret .= $this->prepareChildCategoryList($childCategory);
                $ret .= '</ul>';
            }
        }

        $ret .= '</li>';
        return $ret;
    }

    /**
     * @param string $paramsString
     * @param array|null $paramsArray
     * @return bool
     */
    public function setLinkParams(string $paramsString, ?array $paramsArray = null): bool{

        if(!is_array($paramsArray)){
            $paramsArray = [];
        }

        if(empty($paramsString)){
            $this->setData(array_merge([], $paramsArray));
            return true;
        }
        $paramsString = explode('/', $paramsString);

        if(count($paramsString) <=0){
            $this->setData(array_merge([], $paramsArray));
            return true;
        }

        $setParams = [];
        for($i = 0; $i < count($paramsString); $i = $i + 2){
            if(empty($paramsString[$i]) || empty($paramsString[$i+1])){
                $setParams[CategorySlug::INPUT_NAME] = 'no_validate';
                continue;
            }
            $setParams[$paramsString[$i]] = $paramsString[$i+1];
        }

        $this->setData(array_merge($setParams, $paramsArray));

        return true;

    }

    /**
     * @return array
     */
    public function getSlugsFilters(): array{

        $ret = [
            $this->categorySlug => [
                'label' => 'Wszystkie kategorie'
            ]
        ];

        foreach($this->tagsElements as $element){
            $ret[$element['slug']] = [
                'label' =>  $element['label']
            ];
        }

        return $ret;
    }

    /**
     * @return string
     */
    public function getCategorySlug(): string{
        return $this->categorySlug;
    }

    /**
     * @param string $groupslug
     * @param string $tagSlug
     * @return null|\stdClass
     */
    public function getTagByGroupSlugAndTagSlug(string $groupslug, string $tagSlug): ?\stdClass{

        if(!empty($this->tagsElements[$groupslug]['elements'][$tagSlug])){
            return $this->tagsElements[$groupslug]['elements'][$tagSlug];
        }

        return null;
    }

    /**
     * @return int
     */
    public function getType(): int{
        return $this->type;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

        $this->serviceLocator = $serviceLocator;

        $this->mainCategory = $this->getServiceLocator()->get('Categories')->getMainCategoryByNewsType($this->type);

        if(!$this->mainCategory){
            throw new \Exception('Undefined main category for architecture article');
        }

        foreach($this->tagsElements as $slug => $data){
            $elements = $this->getServiceLocator()->get('Base\Model\Tagi')->getByGroupAssociative($slug);
            if(count($elements) > 0){
                $this->tagsElements[$slug]['slug'] = $slug;
                $this->tagsElements[$slug]['elements'] = $elements;
            }
        }


        $this->prepareFormElements();
        $this->setInputFilter($this->prepareFilter());

        return $this;
    }




    ///*********** [START] FUTURE MOVE TO OUTSIDE LINKER CLASS ****************/

    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    public function prepareLinkWithAdditionalParam(string $key, string $value): string{
        $data = $this->getLinkData();
        $data[$key] = $value;
        return $this->prepareLinkWithData($data);
    }

    /**
     * @param string $key
     * @return string
     */
    public function prepareLinkWithoutParam(string $key): string{
        $data = $this->getLinkData();
        if(isset($data[$key])){
            unset($data[$key]);
        }
        return $this->prepareLinkWithData($data);

    }

    /**
     * @return string
     */
    public function prepareCurrentLink(): string{
        return $this->prepareLinkWithData($this->getLinkData());
    }

    /**
     * @param array $data
     * @param bool $withQuery
     * @return string
     */
    public function prepareLinkWithData(array $data, bool $withQuery = true): string
    {

        $ret = '';

        foreach($this->getLinkParamsInOrder() as $value){
            if(!empty($data[$value])){
                $ret .= '/'.$value.'/'.$data[$value];
            }
        }

        return $ret.(($this->hasQueryParams() and $withQuery) ? '?'.$this->getQueryParamsString(): '');

    }

    /**
     * @param CmsNewsCategoryListEntity $category
     * @return string
     */
    public function prepareLinkToCateogory(CmsNewsCategoryListEntity $category): string{
        return $this->prepareLinkWithData([$this->categorySlug => $category->getSlug()], false);
    }

    /**
     * @return array
     */
    public function getLinkParamsInOrder(): array{

        if(!empty($this->linkParamsInOrder)){
            return $this->linkParamsInOrder;
        }

        $this->linkParamsInOrder = [
            $this->categorySlug
        ];

        foreach($this->tagsElements as $key => $value){
            $this->linkParamsInOrder[] = $key;
        }

        return $this->linkParamsInOrder;

    }

    /**
     * @return array|null
     */
    public function getLinkData(): ?array{

        if($this->linkData !== null){
            return $this->linkData;
        }

        if(!$this->hasValidated){
            $this->linkData = [];
        }else{
            $this->linkData = (array) parent::getData();
        }

        return $this->linkData;

    }

    /**
     * @return array
     */
    public function getQueryParamsArray(): array{

        if($this->queryParamsArray !== null){
            return $this->queryParamsArray;
        }

        $query = [];
        foreach ($this->getLinkData() as $x => $y){
            if(in_array($x, $this->queryParams) and !empty($y)){
                $query[$x] = $y;
            }
        }
        $this->queryParamsString = http_build_query($query);
        return $this->queryParamsArray = $query;

    }

    /**
     * @return string
     */
    public function getQueryParamsString(): string{

        if($this->queryParamsString !== null){
            return $this->queryParamsString;
        }

        $this->getQueryParamsArray();

        return $this->queryParamsString;

    }

    /**
     * @return bool
     */
    public function hasQueryParams(): bool{

        if($this->queryParamsString !== null){
            return $this->queryParamsString != '';
        }

        $this->getQueryParamsArray();

        return $this->queryParamsString != '';

    }

    /**
     * @param string $slug
     * @return bool
     */
    public function searchParamIsAviable(string $slug): bool
    {
        foreach($this->getLinkParamsInOrder() as $value){
            if($slug == $value){
                return true;
            }
        }
        return false;
    }

    ///********************* [END] FUTURE MOVE TO OUTSIDE LINKER CLASS *******************************/

    
}
