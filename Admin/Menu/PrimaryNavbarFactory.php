<?php

/**
 * @see       https://github.com/codenomdev/codeigniter4-framework for the canonical source repository
 *
 * @copyright 2020 - Codenom Dev (https://codenom.com).
 * @license   https://github.com/codenomdev/codeigniter4-framework/blob/master/LICENSE MIT License
 */

namespace Codenom\Framework\Admin\Menu;

class PrimaryNavbarFactory extends \Codenom\Framework\Libraries\Menu\MenuFactory
{
    protected $rootItemName = 'Primary Navbar';

    public function navbar()
    {
        $menuStructure = $this->getNavbar();
        return $this->loader->load($this->buildMenuStructure($menuStructure));
    }

    protected function getNavbar()
    {
        return array_merge($this->userCardNavbar(), $this->notificationNavbar());
    }

    protected function notificationNavbar()
    {
        $notificationStructure = [
            $this->notificationBar()
        ];

        return $notificationStructure;
    }

    protected function notificationBar()
    {
        //before content html
        $headingHtml = '';
        $headingHtml .= '<button class="btn btn-sm btn-dual" type="button" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $headingHtml .= '<i class="fa fa-fw fa-bell"></i>';
        $headingHtml .= '<span class="text-primary"> •</span>';
        $headingHtml .= '</button>';

        //content HTML
        $bodyHtml = '';
        $bodyHtml .= '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">';

        //notification card
        $notificationCard = '';
        $notificationCard .= '<div class="p-2 bg-primary-dark text-center rounded-top">';
        $notificationCard .= '<h5 class="dropdown-header text-uppercase text-white">NOTIFICATIONS</h5>';
        $notificationCard .= '</div>';

        //footer HTML for close bodyHtml
        $footerHtml = '';
        $footerHtml .= '</div>';

        $notificationChildren = [
            'name' => 'Notification',
            'label' => 'Notification',
            'attributes' => [
                'class' => 'dropdown d-inline-block ml-2',
            ],
            'headingHtml' => $headingHtml,
            'bodyHtml' => $bodyHtml,
            'footerHtml' => $footerHtml,
            'order' => 2,
            'children' => [
                [
                    'name' => 'headingNotification',
                    'label' => 'NOTIFICATIONS',
                    'bodyHtml' => $notificationCard
                ],
                [
                    'name' => 'style notification',
                    'bodyHtml' => '<ul class="nav-items mb-0">',
                    'footerHtml' => '</ul>',
                    'extras' => ['notification' => true],
                    'children' => [
                        [
                            'name' => 'test',
                            'label' => 'test',
                            'icon' => 'fa-check-circle',
                            'attributes' => [
                                'time' => true,
                                'label' => '12 Jam yang lalu'
                            ]
                        ],
                        [
                            'name' => 'test2',
                            'label' => 'test2',
                            'icon' => 'fa-check-circle',
                        ]
                    ]
                ]
            ]
        ];

        return $notificationChildren;
    }

    protected function userCardNavbar()
    {
        $userStructure = [
            $this->userCard()
        ];

        return $userStructure;
    }

    protected function userCard()
    {
        // before content HTML
        $headingHtml = '';
        $headingHtml .= '<button class="btn btn-sm btn-dual d-flex align-items-center" type="button" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $headingHtml .= '<img class="rounded-circle animated fadeIn" src="' . admin_static('assets/media/avatar10.jpg') . '" style="width:21px;">';
        $headingHtml .= '<span class="d-none d-sm-inline-block ml-2">Admin</span>';
        $headingHtml .= '<i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1 animated fadeIn"></i>';
        $headingHtml .= '</button>';

        //content HTML
        $bodyHtml = '';
        $bodyHtml .= '<div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">';

        //name card
        $nameCard = '';
        $nameCard .= '<div class="p-3 text-center bg-primary-dark rounded-top">';
        $nameCard .= '<img class="img-avatar img-avatar48 img-avatar-thumb" src="' . admin_static('assets/media/avatar10.jpg') . '">';
        $nameCard .= '<p class="mt-2 mb-0 text-white font-w500">Admin</p>';
        $nameCard .= '<p class="mb-0 text-white-50 font-size-sm">Super Admin</p>';
        $nameCard .= '</div>';

        //footer HTML for close bodyHtml
        $footerHtml = '';
        $footerHtml .= '</div>';

        //sub menu on User Card
        $childBody = '';
        $footerChildBody = '';
        $childBody .= '<div class="p-2">';
        $footerChildBody .= '</div>';

        $menuChildren = [
            'name' => 'User Card',
            'label' => 'User Card',
            'attributes' => [
                'class' => 'dropdown d-inline-block ml-2',
            ],
            'order' => 1,
            'headingHtml' => $headingHtml,
            'bodyHtml' => $bodyHtml,
            'footerHtml' => $footerHtml,
            'children' => [
                [
                    'name' => 'Name Card',
                    'bodyHtml' => $nameCard
                ],
                [
                    'name' => 'userCardSubMenu',
                    'bodyHtml' => $childBody,
                    'footerHtml' => $footerChildBody,
                    'children' => $this->userCardChildrenMenu()
                ]
            ]
        ];

        return $menuChildren;
    }

    protected function userCardChildrenMenu()
    {
        $children = [];
        $children = [
            [
                'name' => 'Inbox',
                'label' => 'Inbox',
                'badge' => 3,
                'order' => 1,
            ],
            [
                'name' => 'Settings',
                'label' => 'Setting',
                'uri' => '#',
                'order' => 2,
            ],
            [
                'name' => 'Logout',
                'label' => 'Logout',
                'uri' => '#',
                'order' => 3,
            ],
        ];

        return $children;
    }
}
