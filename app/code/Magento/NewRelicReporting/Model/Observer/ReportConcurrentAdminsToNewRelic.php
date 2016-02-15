<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\NewRelicReporting\Model\Observer;

use Magento\NewRelicReporting\Model\Config;
use Magento\NewRelicReporting\Model\NewRelicWrapper;

/**
 * Class ReportConcurrentAdminsToNewRelic
 */
class ReportConcurrentAdminsToNewRelic
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $backendAuthSession;

    /**
     * @var NewRelicWrapper
     */
    protected $newRelicWrapper;

    /**
     * Constructor
     *
     * @param Config $config
     * @param \Magento\Backend\Model\Auth\Session $backendAuthSession
     * @param NewRelicWrapper $newRelicWrapper
     */
    public function __construct(
        Config $config,
        \Magento\Backend\Model\Auth\Session $backendAuthSession,
        NewRelicWrapper $newRelicWrapper
    ) {
        $this->config = $config;
        $this->backendAuthSession = $backendAuthSession;
        $this->newRelicWrapper = $newRelicWrapper;
    }

    /**
     * Adds New Relic custom parameters per adminhtml request for current admin user, if applicable
     *
     * @return \Magento\NewRelicReporting\Model\Observer\ReportConcurrentAdminsToNewRelic
     */
    public function execute()
    {
        if ($this->config->isNewRelicEnabled()) {
            if ($this->backendAuthSession->isLoggedIn()) {
                $user = $this->backendAuthSession->getUser();
                $this->newRelicWrapper->addCustomParameter(Config::ADMIN_USER_ID, $user->getId());
                $this->newRelicWrapper->addCustomParameter(Config::ADMIN_USER, $user->getUsername());
                $this->newRelicWrapper->addCustomParameter(
                    Config::ADMIN_NAME,
                    $user->getFirstname() . ' ' . $user->getLastname()
                );
            }
        }

        return $this;
    }
}
