<?php

namespace Codenom\Framework\Config;

// use CodeIgniter\Events\Events;
// use CodeIgniter\Exceptions\FrameworkException;
// use Codenom\Framework\Libraries\Menu\Item as MenuItem;

foreach (glob(APPPATH . 'Modules/*/Admin/Config', GLOB_ONLYDIR) as $events) {
    if (file_exists($events . '/Events.php')) {
        include_once($events . '/Events.php');
    }
}

/*
 * --------------------------------------------------------------------
 * Application Events
 * --------------------------------------------------------------------
 * Events allow you to tap into the execution of the program without
 * modifying or extending core files. This file provides a central
 * location to define your events, though they can always be added
 * at run-time, also, if needed.
 *
 * You create code that can execute by subscribing to events with
 * the 'on()' method. This accepts any form of callable, including
 * Closures, that will be executed when the event is triggered.
 *
 * Example:
 *      Events::on('create', [$myInstance, 'myMethod']);
 */

// Events::on('adminAreaPrimaryNavbar', function (MenuItem $primaryNavbar) {
//     if (!is_null($primaryNavbar->getChild('Notification'))) {
//         $ok = $primaryNavbar->getChild('Notification')
//             ->addChild('Emergency Contacts', array(
//                 'label' => 'emergencyContactset',
//                 'uri' => 'emergency.php',
//                 'order' => '100',
//             ));
//         // return $ok;
//     }
// });
// Events::on('adminAreaSidebar', function (MenuItem $sideBar) {
//     if (!is_null($sideBar->getChild('Setting'))) {
//         $ok = $sideBar->getChild('Setting')
//             ->addChild('Emergency Contacts', array(
//                 'label' => 'emergencyContactset',
//                 'uri' => 'emergency.php',
//                 'order' => '100',
//             ));
//         // return $ok;
//     }
// });
