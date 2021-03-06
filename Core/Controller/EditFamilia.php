<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2017-2018 Carlos Garcia Gomez <carlos@facturascripts.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
namespace FacturaScripts\Core\Controller;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\Lib\ExtendedController;

/**
 * Controller to edit a single item from the Familia model
 *
 * @author Carlos García Gómez <carlos@facturascripts.com>
 * @author Artex Trading sa <jcuello@artextrading.com>
 * @author Fco. Antobnio Moreno Pérez <famphuelva@gmail.com>
 */
class EditFamilia extends ExtendedController\PanelController
{

    /**
     * Returns basic page attributes
     *
     * @return array
     */
    public function getPageData()
    {
        $pagedata = parent::getPageData();
        $pagedata['title'] = 'family';
        $pagedata['menu'] = 'warehouse';
        $pagedata['icon'] = 'fas fa-object-group';
        $pagedata['showonmenu'] = false;

        return $pagedata;
    }

    /**
     * Load views
     */
    protected function createViews()
    {
        $this->addEditView('EditFamilia', 'Familia', 'family');
        $this->addListView('ListFamilia', 'Familia', 'families-children', 'fas fa-level-down-alt');
        $this->addListView('ListProducto', 'Producto', 'products', 'fas fa-cubes');
    }

    /**
     * Load view data procedure
     *
     * @param string                      $viewName
     * @param ExtendedController\EditView $view
     */
    protected function loadData($viewName, $view)
    {
        switch ($viewName) {
            case 'EditFamilia':
                $code = $this->request->get('code');
                $view->loadData($code);
                break;

            case 'ListProducto':
                $codfamilia = $this->getViewModelValue('EditFamilia', 'codfamilia');
                $where = [new DataBaseWhere('codfamilia', $codfamilia)];
                $view->loadData('', $where);
                break;

            case 'ListFamilia':
                $codfamilia = $this->getViewModelValue('EditFamilia', 'codfamilia');
                $where = [new DataBaseWhere('madre', $codfamilia)];
                $view->loadData('', $where);
                break;
        }
    }
}
