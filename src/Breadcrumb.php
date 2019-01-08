<?php

namespace Nagasari\Breadcrumb;

interface Breadcrumb
{
    /**
     * Register crumb to breadcrumb.
     *
     * @param  array|Crumb  $crumb
     *
     * @return self
     */
    public function register($crumb);

    /**
     * Retrieve crumb by id.
     *
     * @param  mixed $id
     *
     * @return Crumb
     */
    public function crumb($id);

    /**
     * Set previous crumb.
     *
     * @param  Crumb  $crumb
     *
     * @return self
     */
    public function prev(Crumb $crumb);
}
