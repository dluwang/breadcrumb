<?php

namespace Dluwang\Breadcrumb;

class InMemoryBreadcrumb implements Breadcrumb
{
    /**
     * @var Collection
     */
    protected $crumbs;

    /**
     * @var null | Crumb
     */
    protected $prev;

    /**
     * Create new instance.
     *
     * @param array $crumbs
     */
    public function __construct(array $crumbs = [])
    {
        $this->crumbs = collect($crumbs);
    }

    /**
     * Register crumb to breadcrumbs.
     *
     * @param  array|Crumb  $crumb
     *
     * @return self
     */
    public function register($crumb): Breadcrumb
    {
        if(is_array($crumb)) {
            foreach ($crumb as $key => $value) {
                $this->register($value);
            }
        }else {
            if(!$this->crumb($crumb->id)) {
                $this->crumbs->push($crumb);
            }
        }

        return $this;
    }

    /**
     * Retrieve crumb by id.
     *
     * @param  mixed $id
     *
     * @return null|Crumb
     */
    public function crumb($id): ?Crumb
    {
        $crumb = $this->crumbs->first(function($value) use ($id){
            return $value->id == $id;
        });

        return $crumb ? $this->applyGlobalPrev($crumb) : $crumb;
    }

    /**
     * Set previous crumb.
     *
     * @param  Crumb  $crumb
     *
     * @return self
     */
    public function prev(Crumb $crumb): Breadcrumb
    {
        $this->prev = $crumb;

        return $this;
    }

    /**
     * Apply global prev.
     *
     * @param  Crumb $crumb
     *
     * @return null|Crumb
     */
    protected function applyGlobalPrev(Crumb $crumb): Crumb
    {
        if($prev = $crumb->prev) {
            $crumb->prev($this->applyGlobalPrev($prev));
        }else {
            if($this->prev) {
                $crumb->prev($this->prev);
            }
        }

        return $crumb;
    }
}
