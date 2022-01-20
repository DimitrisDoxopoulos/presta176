<?php

/**
 * Helps you keep your store neat and clean
 *
 * @package   gmtidy
 * @author    Dariusz Tryba (contact@greenmousestudio.com)
 * @copyright Copyright (c) GreenMouseStudio (http://www.greenmousestudio.com)
 * @license   http://greenmousestudio.com/paid-license.txt
 */
if (!defined('_PS_VERSION_'))
    exit;

class GMTidy extends Module {

    protected $token;
    protected $days;

    public function __construct() {
        $this->name = 'gmtidy';
        $this->tab = 'administration';
        $this->version = '1.3.0';
        $this->author = 'GreenMouseStudio.com';
        $this->module_key = '';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Tidy');
        $this->description = $this->l('Helps you tidy up your shop');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->token = Tools::getAdminToken('gmtidy');
        $this->days = (int) Configuration::get('GMTIDY_DAYS');
    }

    public function install() {
        if (parent::install()) {
            Configuration::updateValue('GMTIDY_DAYS', 30);
            return true;
        }
        return false;
    }

    public function getContent() {
        $content = $this->postProcess();
        $content .= $this->displayStatsPanel();
        $content .= $this->displayButtonPanel('delete-abandoned-carts', $this->l('Delete old abandoned carts'));
        $content .= $this->displayButtonPanel('delete-connections', $this->l('Delete old connections stats'));
        $content .= $this->displayButtonPanel('delete-search-stats', $this->l('Delete old search stats'));
        $content .= $this->displayButtonPanel('delete-email-logs', $this->l('Delete old email logs'));
        $content .= $this->displayButtonPanel('delete-logs', $this->l('Delete old logs'));
        $content .= $this->displayButtonPanel('delete-specific-prices', $this->l('Delete expired specific prices'));
        $content .= $this->displayButtonPanel('delete-vouchers', $this->l('Delete expired vouchers'));
        $content .= $this->displayButtonPanel('regenerate-product-urls',
                $this->l('Regenerate friendly URL\'s for products'));
        $content .= $this->displayButtonPanel('regenerate-category-urls',
                $this->l('Regenerate friendly URL\'s for categories'));
        $content .= $this->displayButtonPanel('cat-assign', $this->l('Set product\'s deepest category as default'));
        $content .= $this->displayButtonPanel('cat-parents', $this->l('Assign products to all parent categories'));
        $content .= $this->displayButtonPanel('cat-groups', $this->l('Assign all customer groups to all categories'));
        $content .= $this->displayButtonPanel('cat-deact',
                $this->l('Deactivate active categories without active products'));
        $content .= $this->displayButtonPanel('cat-activate',
                $this->l('Activate inactive categories with active products'));
        $content .= $this->displayButtonPanel('prod-deact',
                $this->l('Deactivate active products without active categories'));
        $content .= $this->displayButtonPanel('man-deact',
                $this->l('Deactivate active manufacturers without active products'));
        $content .= $this->displayButtonPanel('man-activate',
                $this->l('Activate inactive manufacturers with active products'));
        $content .= $this->displayButtonPanel('fix-covers',
                $this->l('Set first image as cover for products without cover'));
        $content .= $this->displayButtonPanel('cover-first', $this->l('Set cover as first image'));
        $content .= $this->displayButtonPanel('delete-tmp-img', $this->l('Delete temporary images'));
        $content .= $this->displayButtonPanel('cheapest-comb', $this->l('Set cheapest combinations as default'));
        return $content . $this->displayForm() .
                $this->context->smarty->fetch($this->local_path . 'views/templates/admin/gms.tpl');
    }

    protected function displayStatsPanel() {

        $this->context->smarty->assign(array(
            'abandonedCarts' => number_format($this->countAbandonedCarts()),
            'connectionsStats' => number_format($this->countConnections()),
            'searchStats' => number_format($this->countSearchStats()),
            'emailLogs' => number_format($this->countEmailLogs()),
            'logs' => number_format($this->countLogs()),
            'expiredSpecificPrices' => number_format($this->countExpiredSpecificPrices()),
            'expiredVouchers' => number_format($this->countExpiredVouchers())
        ));
        return $this->context->smarty->fetch($this->local_path . 'views/templates/admin/stats.tpl');
    }

    protected function displayForm() {
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Interval in days'),
                        'name' => 'GMTIDY_DAYS',
                        'hint' => $this->l('Used for deleting old data'),
                        'class' => 'fixed-width-xs',
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();
        $helper->id = (int) Tools::getValue('id_carrier');
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submit' . $this->name;
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper->generateForm(array($fields_form));
    }

    protected function getConfigFieldsValues() {
        return array(
            'GMTIDY_DAYS' => (int) Configuration::get('GMTIDY_DAYS'),
        );
    }

    protected function displayButtonPanel($name, $caption) {
        $content = '<div class="panel">';
        $content .= '<form method="post" action="">';
        $content .= '<div class="form-group">';
        $content .= '<button type="submit" name="submit-' . $name . '" class="btn btn-default">'
                . '<i class="icon-check"></i> ' . $caption . '</button>';
        $content .= '</form>';
        $content .= '</div>';
        $url = Tools::getHttpHost(true) . __PS_BASE_URI__ . 'modules/' . $this->name . '/cron-' . $name . '.php?token=' . $this->token;
        $content .= '<p>' . $this->l('Cron URL:') . ' ' . $url . '</p>';
        $content .= '</div>';
        return $content;
    }

    protected function postProcess() {
        $result = '';
        if (Tools::isSubmit('submit' . $this->name)) {
            $nbr = (int) Tools::getValue('GMTIDY_DAYS');
            if ($nbr < 0 || $nbr > 1000) {
                $nbr = 1000;
            }
            Configuration::updateValue('GMTIDY_DAYS', $nbr);
            $result .= $this->displayConfirmation($this->l('Settings updated'));
        }
        if (Tools::isSubmit('submit-man-deact')) {
            if ($this->deactivateManufacturersWithoutActiveProducts() != false) {
                $result .= $this->displayConfirmation($this->l('Deactivate active manufacturers without active products') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-man-activate')) {
            if ($this->activateManufacturersWithActiveProducts() != false) {
                $result .= $this->displayConfirmation($this->l('Activate inactive manufacturers with active products') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-cat-deact')) {
            if ($this->deactivateCategoriesWithoutActiveProducts() != false) {
                $result .= $this->displayConfirmation($this->l('Deactivate active categories without active products') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-prod-deact')) {
            if ($this->deactivateProductsWithoutActiveCategories() != false) {
                $result .= $this->displayConfirmation($this->l('Deactivate active products without active categories') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-cat-groups')) {
            if ($this->assingAllUserGroupsToAllProductCategories() != false) {
                $result .= $this->displayConfirmation($this->l('Assign all customer groups to all categories') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-cat-activate')) {
            if ($this->activateCategoriesWithActiveProducts() != false) {
                $result .= $this->displayConfirmation($this->l('Activate inactive categories with active products') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-cat-assign')) {
            if ($this->assignProductsDeepestCategoryAsDefault() != false) {
                $result .= $this->displayConfirmation($this->l('Set product\'s deepest category as default') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-cat-parents')) {
            if ($this->assignProductsToAllParentCategories() != false) {
                $result .= $this->displayConfirmation($this->l('Assign products to all parent categories') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-regenerate-product-urls')) {
            if ($this->regenerateProductUrls() != false) {
                $result .= $this->displayConfirmation($this->l('Regenerate friendly URL\'s for products') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-regenerate-category-urls')) {
            if ($this->regenerateCategoryUrls() != false) {
                $result .= $this->displayConfirmation($this->l('Regenerate friendly URL\'s for categories') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-delete-abandoned-carts')) {
            if ($this->deleteOldAbandonedShoppingCarts() != false) {
                $result .= $this->displayConfirmation($this->l('Delete old abandoned carts') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-delete-connections')) {
            if ($this->deleteOldConnectionStats() != false) {
                $result .= $this->displayConfirmation($this->l('Delete old connections stats') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-delete-search-stats')) {
            if ($this->deleteOldSearchStats() != false) {
                $result .= $this->displayConfirmation($this->l('Delete old search stats') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-delete-specific-prices')) {
            if ($this->deleteExpiredSpecificPrices() != false) {
                $result .= $this->displayConfirmation($this->l('Delete expired specific prices') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-delete-vouchers')) {
            if ($this->deleteExpiredVouchers() != false) {
                $result .= $this->displayConfirmation($this->l('Delete expired vouchers') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-delete-email-logs')) {
            if ($this->deleteOldEmailLogs() != false) {
                $result .= $this->displayConfirmation($this->l('Delete old email logs') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-delete-logs')) {
            if ($this->deleteOldLogs() != false) {
                $result .= $this->displayConfirmation($this->l('Delete old logs') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-fix-covers')) {
            if ($this->fixCovers() != false) {
                $result .= $this->displayConfirmation($this->l('Set first image as cover for products without cover') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-cover-first')) {
            if ($this->coverFirst() != false) {
                $result .= $this->displayConfirmation($this->l('Set cover as first image') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-delete-tmp-img')) {
            if ($this->deleteTemporaryImages() != false) {
                $result .= $this->displayConfirmation($this->l('Delete temporary images') . ' - ' . $this->l('Request processed'));
            }
        }
        if (Tools::isSubmit('submit-cheapest-comb')) {
            if ($this->setCheapestCombinationsAsDefault() != false) {
                $result .= $this->displayConfirmation($this->l('Set cheapest combinations as default') . ' - ' . $this->l('Request processed'));
            }
        }
        return $result;
    }

    public function deleteTemporaryImages() {
        array_map('unlink', glob(_PS_TMP_IMG_DIR_ . "/*"));
        array_map('unlink', glob(_PS_TMP_IMG_DIR_ . "/cms/*"));
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Delete temporary images'));
        return true;
    }

    public function coverFirst() {
        $query = 'SELECT `id_image` FROM `' . _DB_PREFIX_ . 'image` WHERE `cover` > 0 AND `position` > 1';
        $result = Db::getInstance()->executeS($query);
        if ($result) {
            foreach ($result as $row) {
                $imageId = $row['id_image'];
                $img = new Image($imageId);
                $img->updatePosition(0, 1);
            }
        }
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Set cover as first image'));
        return true;
    }

    public function deleteExpiredSpecificPrices() {
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'specific_price` WHERE `id_specific_price_rule` = 0 AND'
                . ' `to` > 0 AND `to` < NOW()';
        Db::getInstance()->execute($query);
        $query = 'OPTIMIZE TABLE `' . _DB_PREFIX_ . 'specific_price`';
        Db::getInstance()->execute($query);
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Delete expired specific prices'));
        return true;
    }

    protected function countExpiredSpecificPrices() {
        $query = 'SELECT COUNT(`id_specific_price`) FROM `' . _DB_PREFIX_ . 'specific_price` WHERE `id_specific_price_rule` = 0 AND'
                . ' `to` > 0 AND `to` < NOW()';
        return Db::getInstance()->getValue($query);
    }

    public function deleteExpiredVouchers() {
        $query = 'SELECT `id_cart_rule` FROM `' . _DB_PREFIX_ . 'cart_rule` '
                . ' WHERE `date_to` > 0 AND `date_to` < NOW()';
        $result = Db::getInstance()->executeS($query);
        if ($result) {
            foreach ($result as $row) {
                $cartRuleId = (int) $row['id_cart_rule'];
                $cartRule = new CartRule($cartRuleId);
                $cartRule->delete();
            }
        }
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Delete expired vouchers'));
        return true;
    }

    protected function countExpiredVouchers() {
        $query = 'SELECT COUNT(`id_cart_rule`) FROM `' . _DB_PREFIX_ . 'cart_rule` '
                . ' WHERE `date_to` > 0 AND `date_to` < NOW()';
        return Db::getInstance()->getValue($query);
    }

    public function fixCovers() {
        //set covers for products without covers
        $query = 'SELECT `id_product`, MIN(`id_image`) as `id_image`, SUM(`cover`) as `sum` FROM `' . _DB_PREFIX_ . 'image` GROUP BY `id_product`';
        $result = Db::getInstance()->executeS($query);
        if ($result) {
            foreach ($result as $row) {
                $productId = $row['id_product'];
                $imageId = $row['id_image'];
                $sum = (int) $row['sum'];
                if ($sum < 1) {
                    Image::deleteCover($productId);
                    $img = new Image($imageId);
                    $img->cover = 1;
                    $img->update();
                }
            }
        }
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Set first image as cover for products without cover'));
        return true;
    }

    public function deleteOldEmailLogs() {
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'mail` '
                . ' WHERE date_add <= DATE_SUB(NOW(), INTERVAL ' . $this->days . ' DAY)';
        Db::getInstance()->execute($query);
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Delete old email logs'));
        return true;
    }

    protected function countEmailLogs() {
        $query = 'SELECT COUNT(`id_mail`) FROM `' . _DB_PREFIX_ . 'mail` ';
        return Db::getInstance()->getValue($query);
    }

    public function deleteOldLogs() {
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'log` '
                . ' WHERE date_add <= DATE_SUB(NOW(), INTERVAL ' . $this->days . ' DAY)';
        Db::getInstance()->execute($query);
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Delete old logs'));
        return true;
    }

    protected function countLogs() {
        $query = 'SELECT COUNT(`id_log`) FROM `' . _DB_PREFIX_ . 'log` ';
        return Db::getInstance()->getValue($query);
    }

    public function deleteOldSearchStats() {
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'statssearch` '
                . ' WHERE date_add <= DATE_SUB(NOW(), INTERVAL ' . $this->days . ' DAY)';
        Db::getInstance()->execute($query);
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Delete old search stats'));
        return true;
    }

    protected function countSearchStats() {
        $query = 'SELECT COUNT(`id_statssearch`) FROM `' . _DB_PREFIX_ . 'statssearch` ';
        return Db::getInstance()->getValue($query);
    }

    public function deleteOldConnectionStats() {
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'connections_page`
			WHERE time_start <= LAST_DAY(DATE_SUB(NOW(), INTERVAL ' . $this->days . ' DAY))';
        Db::getInstance()->execute($query);
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'connections` '
                . ' WHERE date_add <= DATE_SUB(NOW(), INTERVAL ' . $this->days . ' DAY)';
        Db::getInstance()->execute($query);
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'guest` WHERE `id_guest` NOT IN '
                . ' (SELECT `id_guest` FROM `' . _DB_PREFIX_ . 'connections`) '
                . ' AND `id_customer` = 0';
        Db::getInstance()->execute($query);
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'pagenotfound` '
                . ' WHERE date_add <= DATE_SUB(NOW(), INTERVAL ' . $this->days . ' DAY)';
        Db::getInstance()->execute($query);
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'connections_source` '
                . ' WHERE `date_add` <= DATE_SUB(NOW(), INTERVAL ' . $this->days . ' DAY)';
        Db::getInstance()->execute($query);
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'date_range` '
                . ' WHERE time_start <= DATE_SUB(NOW(), INTERVAL ' . $this->days . ' DAY)';
        Db::getInstance()->execute($query);
        $query = 'DELETE FROM `' . _DB_PREFIX_ . 'page_viewed` '
                . ' WHERE `id_date_range` NOT IN (SELECT `dr`.`id_date_range` FROM `' . _DB_PREFIX_ . 'date_range` `dr`)';
        Db::getInstance()->execute($query);
        $query = 'OPTIMIZE TABLE `' . _DB_PREFIX_ . 'connections_page`,'
                . '`' . _DB_PREFIX_ . 'connections`, '
                . '`' . _DB_PREFIX_ . 'guest`, '
                . '`' . _DB_PREFIX_ . 'pagenotfound`, '
                . '`' . _DB_PREFIX_ . 'connections_source`, '
                . '`' . _DB_PREFIX_ . 'date_range`, '
                . '`' . _DB_PREFIX_ . 'page_viewed`;';
        Db::getInstance()->execute($query);
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Delete old connections stats'));
        return true;
    }

    protected function countConnections() {
        $result = 0;
        $res = Db::getInstance()->execute('SHOW TABLES LIKE `' . _DB_PREFIX_ . 'connections`');
        $result += Db::getInstance()->getValue('SELECT COUNT(*) AS `count` FROM `' . _DB_PREFIX_ . 'connections`');
        $result += Db::getInstance()->getValue('SELECT COUNT(*) AS `count` FROM `' . _DB_PREFIX_ . 'connections_page`');
        $result += Db::getInstance()->getValue('SELECT COUNT(*) AS `count` FROM `' . _DB_PREFIX_ . 'guest`');
        $result += Db::getInstance()->getValue('SELECT COUNT(*) AS `count` FROM `' . _DB_PREFIX_ . 'pagenotfound`');
        $result += Db::getInstance()->getValue('SELECT COUNT(*) AS `count` FROM `' . _DB_PREFIX_ . 'connections_source`');
        $result += Db::getInstance()->getValue('SELECT COUNT(*) AS `count` FROM `' . _DB_PREFIX_ . 'date_range`');
        $result += Db::getInstance()->getValue('SELECT COUNT(*) AS `count` FROM `' . _DB_PREFIX_ . 'page_viewed`');
        return $result;
    }

    public function deleteOldAbandonedShoppingCarts() {
        $query = 'SELECT `c`.`id_cart` FROM `' . _DB_PREFIX_ . 'cart` `c` '
                . ' WHERE  `c`.`date_upd` <= DATE_SUB(NOW(), INTERVAL ' . $this->days . ' DAY)'
                . ' AND `c`.`id_cart` NOT IN (SELECT `o`.`id_cart` FROM `' . _DB_PREFIX_ . 'orders` `o`)';
        $result = Db::getInstance()->executeS($query);
        if ($result) {
            foreach ($result as $row) {
                $cart = new Cart($row['id_cart']);
                $cart->delete();
            }
        }
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Delete old abandoned carts'));
        return true;
    }

    protected function countAbandonedCarts() {
        $query = 'SELECT COUNT(`c`.`id_cart`) AS `count` FROM `' . _DB_PREFIX_ . 'cart` `c` '
                . ' WHERE `c`.`id_cart` NOT IN (SELECT `o`.`id_cart` FROM `' . _DB_PREFIX_ . 'orders` `o`)';
        $result = Db::getInstance()->getValue($query);
        return $result;
    }

    public function regenerateProductUrls() {
        $query = 'SELECT `id_product`, `name`, `id_shop`, `id_lang`, `link_rewrite` FROM ' . _DB_PREFIX_ . 'product_lang';
        $result = Db::getInstance()->executeS($query);
        if ($result) {
            $counter = 0;
            foreach ($result as $product) {
                $newLink = Tools::link_rewrite($product['name']);
                if (strcmp($newLink, $product['link_rewrite']) !== 0) {
                    $counter++;
                    Db::getInstance()->update('product_lang', array('link_rewrite' => $newLink),
                            '`id_product` = ' . $product['id_product'] . ' AND '
                            . '`id_shop` = ' . $product['id_shop'] . ' AND '
                            . '`id_lang` = ' . $product['id_lang']);
                }
            }
            PrestaShopLogger::addLog('Tidy - ' . $counter . ' product links regenerated');
        }
        return true;
    }

    public function regenerateCategoryUrls() {
        $query = 'SELECT `id_category`, `name`, `id_shop`, `id_lang`, `link_rewrite` FROM ' . _DB_PREFIX_ . 'category_lang';
        $result = Db::getInstance()->executeS($query);
        if ($result) {
            $counter = 0;
            foreach ($result as $category) {
                $newLink = Tools::link_rewrite($category['name']);
                if (strcmp($newLink, $category['link_rewrite']) !== 0) {
                    $counter++;
                    Db::getInstance()->update('category_lang',
                            array('link_rewrite' => $newLink),
                            'id_category = ' . $category['id_category'] . ' AND '
                            . '`id_shop` = ' . $category['id_shop'] . ' AND '
                            . '`id_lang` = ' . $category['id_lang']);
                }
            }
            PrestaShopLogger::addLog('Tidy - ' . $counter . ' category links regenerated');
        }
        return true;
    }

    public function assignProductsDeepestCategoryAsDefault() {
        $data = $this->getDefaultCategories();
        if ($data) {
            foreach ($data as $productId => $categoryId) {
                $query = 'UPDATE `' . _DB_PREFIX_ . 'product` SET `id_category_default` = ' . $categoryId . ' WHERE `id_product` = ' . $productId . ' ';
                Db::getInstance()->execute($query);
                $query = 'UPDATE `' . _DB_PREFIX_ . 'product_shop` SET `id_category_default` = ' . $categoryId . ' WHERE `id_product` = ' . $productId . ' ';
                Db::getInstance()->execute($query);
            }
        }
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Set product\'s deepest category as default'));
        return true;
    }

    public function assingAllUserGroupsToAllProductCategories() {
        $langId = Configuration::get('PS_LANG_DEFAULT');
        $shops = Shop::getShops();
        foreach ($shops as $shop) {
            $shopId = $shop['id_shop'];
            $groups = Group::getGroups($langId, $shopId);
            $groupIds = array();
            foreach ($groups as $group) {
                $groupIds[] = $group['id_group'];
            }
            $categories = Category::getSimpleCategories($langId);
            foreach ($categories as $category) {
                $id = $category['id_category'];
                $c = new Category($id);
                if ($c->getShopID() == $shopId) {
                    $c->updateGroup($groupIds);
                }
            }
        }
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Assign all customer groups to all categories'));
        return true;
    }

    public function assignProductsToAllParentCategories() {
        $items = Product::getProducts($this->context->language->id, 0, 0, 'id_product', 'ASC', false, true);
        foreach ($items as $item) {
            $product = new Product($item['id_product']);
            $categories = Product::getProductCategories($item['id_product']);
            foreach ($categories as $category) {
                $parentCategories = $this->getParentCategories((int) $category);
                $categoriesToAdd = array();
                foreach ($parentCategories as $parentCategory) {
                    if (($parentCategory['level_depth'] > 1) && ($parentCategory['is_root_category'] == 0)) {
                        $categoriesToAdd[] = $parentCategory['id_category'];
                    }
                }
                $product->addToCategories($categoriesToAdd);
            }
        }
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Assign products to all parent categories'));
        return true;
    }

    protected function getParentCategories($categoryId, $id_lang = null) {
        if (!$id_lang) {
            $id_lang = Context::getContext()->language->id;
        }
        $interval = Category::getInterval($categoryId);
        $sql = new DbQuery();
        $sql->from('category', 'c');
        $sql->leftJoin('category_lang', 'cl',
                'c.id_category = cl.id_category AND id_lang = ' . (int) $id_lang . Shop::addSqlRestrictionOnLang('cl'));
        $sql->where('c.nleft <= ' . (int) $interval['nleft'] . ' AND c.nright >= ' . (int) $interval['nright']);
        $sql->orderBy('c.nleft');

        return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
    }

    protected function getDefaultCategories() {
        $query = 'SELECT `p`.`id_product` AS `id`, `cp`.`id_category`, `c`.`level_depth` `level_depth` FROM `' . _DB_PREFIX_ . 'product` `p` JOIN `' . _DB_PREFIX_ . 'category_product` `cp` ON `p`.`id_product` = `cp`.`id_product` JOIN `' . _DB_PREFIX_ . 'category` `c` ON `cp`.`id_category` = `c`.`id_category` ORDER BY `id` ASC, `level_depth` DESC';
        $result = Db::getInstance()->executeS($query);
        $data = array();
        foreach ($result as $row) {
            $data[$row['id']][] = array(
                'id_category' => $row['id_category'],
                'level_depth' => $row['level_depth']);
        }
        $deepestCategories = array();
        foreach ($data as $productId => $items) {
            $maxLevel = $items[0]['level_depth'];
            $deepestCategories[$productId] = $items[0]['id_category'];
            foreach ($items as $item) {
                if ($item['level_depth'] > $maxLevel) {
                    $maxLevel = $item['level_depth'];
                    $deepestCategories[$productId] = $item['id_category'];
                }
            }
        }
        return $deepestCategories;
    }

    protected function getProductIds() {
        $query = 'SELECT `id_product` AS `id` FROM `' . _DB_PREFIX_ . 'product` ';
        echo $query;
        $result = Db::getInstance()->executeS($query);
        $ids = array();
        foreach ($result as $row) {
            $ids[] = $row['id'];
        }
        return $ids;
    }

    public function deactivateCategoriesWithoutActiveProducts() {
        $categories = implode(',', $this->getCategoriesWithActiveProducts());
        $result = Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'category` SET `active` = 0, `date_upd` = NOW()'
                . ' WHERE `id_category` NOT IN (' . $categories . ') AND `active` = 1');
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Deactivate active categories without active products'));
        return $result;
    }

    public function activateCategoriesWithActiveProducts() {
        $categories = implode(',', $this->getCategoriesWithActiveProducts());
        $result = Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'category` SET `active` = 1, `date_upd` = NOW()'
                . ' WHERE `id_category` IN (' . $categories . ') AND `active` = 0');
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Activate inactive categories with active products'));
        return $result;
    }

    protected function getCategoriesWithActiveProducts() {
        $categoryParents = $this->getCategoriesParents();
        $query = 'SELECT  `' . _DB_PREFIX_ . 'category_product`.`id_category`, SUM(`' . _DB_PREFIX_ . 'product`.`active` ) AS  `active_products`
	FROM  `' . _DB_PREFIX_ . 'category_product`
	JOIN  `' . _DB_PREFIX_ . 'category` ON  `' . _DB_PREFIX_ . 'category`.`id_category` =  `' . _DB_PREFIX_ . 'category_product`.`id_category`
	JOIN  `' . _DB_PREFIX_ . 'product` ON  `' . _DB_PREFIX_ . 'product`.`id_product` =  `' . _DB_PREFIX_ . 'category_product`.`id_product`
	GROUP BY  `' . _DB_PREFIX_ . 'category_product`.`id_category`
	HAVING  `active_products` > 0';
        $result = Db::getInstance()->executeS($query);
        $categoriesWithProducts = array();
        $parentsWithProducts = array();
        foreach ($result as $row) {
            $categoriesWithProducts[] = $row['id_category'];
            $parentsWithProducts[] = $categoryParents[$row['id_category']];
        }

        $list = implode(',', $categoriesWithProducts) . ',' . implode(',', $parentsWithProducts);
        $uniqueList = array_unique(explode(',', $list));
        sort($uniqueList);
        return $uniqueList;
    }

    protected function getCategoriesParents() {
        $result = Db::getInstance()->executeS('SELECT `id_category`, `id_parent` FROM `' . _DB_PREFIX_ . 'category`');
        $categories = array();
        foreach ($result as $row) {
            $categories[$row['id_category']] = $row['id_parent'];
        }
        $categoryParents = array();
        foreach ($categories as $category => $parent) {
            $parentsTree = array($parent);
            while ($parent != 0) {
                //non existing categories protection
                if (!array_key_exists($parent, $categories)) {
                    $parent = 0;
                } else {
                    $parent = $categories[$parent];
                }
                //infinite loop protection
                if (!in_array($parent, $parentsTree)) {
                    $parentsTree[] = $parent;
                } else {
                    $parent = 0;
                    $parentsTree[] = $parent;
                }
            }
            $categoryParents[$category] = implode(',', $parentsTree);
        }
        return $categoryParents;
    }

    public function activateManufacturersWithActiveProducts() {
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Activate inactive manufacturers with active products'));
        return Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'manufacturer` SET `active` = 1, `date_upd` = NOW()'
                        . ' WHERE `id_manufacturer` IN'
                        . ' (SELECT `id` FROM (SELECT `id_manufacturer` AS `id`, SUM(`active`) AS `active_products`'
                        . ' FROM `' . _DB_PREFIX_ . 'product` GROUP BY `id_manufacturer` HAVING `active_products` > 0) AS `alias`)'
                        . ' AND `active` = 0');
    }

    public function deactivateManufacturersWithoutActiveProducts() {
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Deactivate active manufacturers without active products'));
        return Db::getInstance()->execute('UPDATE `' . _DB_PREFIX_ . 'manufacturer` SET `active` = 0, `date_upd` = NOW() '
                        . ' WHERE `id_manufacturer` NOT IN '
                        . ' (SELECT `id` FROM (SELECT `id_manufacturer` AS `id`, SUM(`active`) AS `active_products` '
                        . ' FROM `' . _DB_PREFIX_ . 'product` GROUP BY `id_manufacturer` HAVING `active_products` > 0) AS `alias`) '
                        . ' AND `active` = 1');
    }

    public function deactivateProductsWithoutActiveCategories() {
        $categoryMap = array();
        $query = 'SELECT `id_category`, `active` FROM `' . _DB_PREFIX_ . 'category`';
        $result = Db::getInstance()->executeS($query);
        if ($result) {
            foreach ($result as $row) {
                $categoryMap[$row['id_category']] = $row['active'];
            }
        }
        $query = 'SELECT `id_product` FROM `' . _DB_PREFIX_ . 'product_shop` WHERE `active` = 1';
        $result = Db::getInstance()->executeS($query);
        if ($result) {
            foreach ($result as $row) {
                $p = new Product($row['id_product']);
                $productCategories = $p->getCategories();
                $turnOffProduct = true;
                foreach ($productCategories as $categoryId) {
                    if ($categoryMap[$categoryId] > 0) {
                        $turnOffProduct = false;
                        break;
                    }
                }
                if ($turnOffProduct) {
                    $p->toggleStatus();
                }
            }
        }
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Deactivate active products without active categories'));
        return true;
    }

    public function setCheapestCombinationsAsDefault($verbose = false) {
        $shops = Shop::getShops();
        foreach ($shops as $shop) {
            $shopId = $shop['id_shop'];
            if ($verbose) {
                echo 'Shop: ' . $shopId . '<br/>';
            }
            $productQuery = 'SELECT DISTINCT `id_product` FROM `' . _DB_PREFIX_ . 'product_attribute_shop` '
                    . ' WHERE `id_shop` = ' . $shopId
                    . ' ORDER BY `id_product` ASC ';
            $result = Db::getInstance()->executeS($productQuery);
            if ($result) {
                foreach ($result as $row) {
                    $productId = (int) $row['id_product'];
                    $minimumQuery = 'SELECT `id_product_attribute`, `price`, `default_on` FROM `' . _DB_PREFIX_ . 'product_attribute_shop` '
                            . ' WHERE `id_product` = ' . $productId . ' AND `id_shop` = ' . $shopId
                            . ' ORDER BY `price` ASC';
                    $minimumRow = Db::getInstance()->getRow($minimumQuery);
                    $minAttributeId = (int) $minimumRow['id_product_attribute'];
                    $minPrice = (float) $minimumRow['price'];
                    $defaultOn = (int) $minimumRow['default_on'];
                    if ($verbose) {
                        echo 'ID: ' . $productId . ' ';
                        echo " min attr id: {$minAttributeId}, min price: {$minPrice}";
                    }
                    if ($defaultOn == 1) {
                        //do no changes
                        if ($verbose) {
                            echo ' - already default';
                        }
                    } else {
                        $defaultQuery = 'SELECT `id_product_attribute`, `price`, `default_on` FROM `' . _DB_PREFIX_ . 'product_attribute_shop` '
                                . ' WHERE `id_product` = ' . $productId . ' AND `default_on` = 1' . ' AND `id_shop` = ' . $shopId;
                        $defaultRow = Db::getInstance()->getRow($defaultQuery);
                        $defaultAttributeId = (int) $defaultRow['id_product_attribute'];
                        $defaultPrice = (float) $defaultRow['price'];
                        if ($verbose) {
                            echo ", default attr id: {$defaultAttributeId}, default price: {$defaultPrice}";
                        }
                        if ($defaultPrice >= ($minPrice + 0.01)) {
                            Db::getInstance()->update('product_attribute', array(
                                'default_on' => NULL
                                    ), '`id_product_attribute` = ' . $defaultAttributeId);
                            Db::getInstance()->update('product_attribute_shop', array(
                                'default_on' => NULL
                                    ), '`id_product_attribute` = ' . $defaultAttributeId . ' AND `id_shop` = ' . $shopId);

                            Db::getInstance()->update('product_attribute_shop', array(
                                'default_on' => 1
                                    ), '`id_product_attribute` = ' . $minAttributeId . ' AND `id_shop` = ' . $shopId);
                            Db::getInstance()->update('product_attribute', array(
                                'default_on' => 1
                                    ), '`id_product_attribute` = ' . $minAttributeId);
                            if ($verbose) {
                                echo ' - changing from ' . $defaultAttributeId . ' to ' . $minAttributeId;
                            }
                        } else {
                            if ($verbose) {
                                echo ' - default price is the same as minimum';
                            }
                        }
                    }
                    if ($verbose) {
                        echo "<br/>";
                    }
                }
            }
        }
        PrestaShopLogger::addLog('Tidy - ' . $this->l('Set cheapest combinations as default'));
        return true;
    }

}
