<?php

namespace Nagasari\Breadcrumb;

use JsonSerializable;

class Crumb implements JsonSerializable
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var Crumb
     */
    protected $prev;

    /**
     * Create new instance.
     *
     * @param mixed         $id
     * @param string        $label
     * @param string        $url
     * @param Crumb|null    $prev
     */
    public function __construct($id, $label, $url, Crumb $prev = null)
    {
        $this->id = $id;
        $this->label = $label;
        $this->url = $url;
        $this->prev = $prev;
    }

    /**
     * Prepend crumb.
     *
     * @param  Crumb  $crumb
     *
     * @return self
     */
    public function prev(Crumb $crumb)
    {
        $this->prev = $crumb;

        return $this;
    }

    /**
     * Cast crumb to json.
     *
     * @param  integer  $options
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Cast crumb to array.
     *
     * @return array
     */
    public function toArray()
    {
        $crumbs = collect([
            [
                'id' => $this->id,
                'label' => $this->label,
                'url' => $this->url
            ]
        ]);

        if($this->prev) {
            $prev = collect($this->prev->toArray());

            $crumbs = $prev->merge($crumbs);
        }

        return $crumbs->toArray();
    }

    /**
     * Serialize json.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Cast crumb to string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Retrieve property dynamically.
     *
     * @param  string $prop
     *
     * @return mixed
     */
    public function __get($prop)
    {
        return isset($this->{$prop}) ? $this->{$prop} : null;
    }
}
