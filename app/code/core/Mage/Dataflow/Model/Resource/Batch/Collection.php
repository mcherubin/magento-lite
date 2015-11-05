<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Dataflow
 * @copyright  Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Dataflow batch collection
 *
 * @category    Mage
 * @package     Mage_Dataflow
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Dataflow_Model_Resource_Batch_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Init model
     *
     */
    protected function _construct()
    {
        $this->_init('dataflow/batch');
    }

    /**
     * Add expire filter (for abandoned batches)
     *
     */
    public function addExpireFilter()
    {
        $date = Mage::getSingleton('core/date');
        /* @var $date Mage_Core_Model_Date */
        $lifetime = Mage_Dataflow_Model_Batch::LIFETIME;
        $expire   = $date->gmtDate(null, $date->timestamp() - $lifetime);

        $this->getSelect()->where('created_at < ?', $expire);
    }
}
