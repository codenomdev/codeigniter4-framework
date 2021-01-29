<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Admin\Breadcrumb;

class BreadcrumbFactory
{
    private $breadcrumbHtml = '';
    protected $clikable = TRUE;
    protected $breadcrumb = [];

    public function addToBreadcrumb($link, $text)
    {
        $base_url = $link;

        if (\FILTER_VAR($link, \FILTER_VALIDATE_URL) == false) {
            $base_url = \admin_url($link);
        }
        $this->breadcrumb[] = ['link' => $base_url, 'label' => $text];

        return $this;
    }

    public function resetBreadcrumb()
    {
        $this->breadcrumb = array();
        return $this;
    }

    /**
     * Build Breadcrumb HTML
     */
    protected function buildBreadcrumbHtml()
    {
        $breadcrumb = [];
        $crumbs = array_filter($this->breadcrumb);
        $count = count($crumbs);

        if ($this->clikable) {
            $count = count($crumbs) - 1;
        }
        foreach ($this->breadcrumb as $key => $val) {
            if ($val['link'] == 'backend' || $val['label'] == 'Backend') {
                $breadcrumb[] = '<li class="breadcrumb-item">' . anchor(admin_url('dashboard'), 'Dashboard') . '</li>';
            } elseif ($key != $count) {
                $breadcrumb[] = '<li class="breadcrumb-item">' . anchor($val['link'], $val['label']) . '</li>';
            } else {
                $breadcrumb[] = '<li class="breadcrumb-item">' . $val['label'] . '</li>';
            }
        }

        return $breadcrumb;
    }

    /**
     * Get Breadcrumb
     */
    public function getBreadcrumb()
    {
        if ($this->breadcrumbHtml) {
            return $this->breadcrumbHtml;
        }
        return $this->buildBreadcrumbHtml();
    }

    /**
     * Set Breadcrumb
     */
    public function setBreadCrumbHtml($breadCrumbHtml)
    {
        $this->breadCrumbHtml = $breadCrumbHtml;
        return $this;
    }
}
