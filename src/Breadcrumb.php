<?php

namespace Dluwang\Breadcrumb;

interface Breadcrumb
{
    /**
     * Register crumb to breadcrumb.
     *
     * @param  array|Crumb  $crumb
     *
     * @return self
     */
    public function register($crumb): Breadcrumb;

    /**
     * Retrieve crumb by id.
     *
     * @param  mixed $id
     *
     * @return null|Crumb
     */
    public function crumb($id): ?Crumb;

    /**
     * Set previous crumb.
     *
     * @param  Crumb  $crumb
     *
     * @return self
     */
    public function prev(Crumb $crumb): Breadcrumb;
}
