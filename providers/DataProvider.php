<?php

/**
 * DataProvider class is an adapter which is used to retrieve filelist
 *
 * @author luke
 */
class DataProvider
{

    /**
     * Stores object which implements DataProviderInterface
     * @var object 
     */
    private $provider;

    /**
     * Constructor. Is used to set $provider
     * @param DataProviderInterface $providerObj
     */
    public function __construct(DataProviderInterface $providerObj)
    {
        $this->provider = $providerObj;
    }

    /**
     * Retrieves file list from a specified provider
     * @return array
     */
    public function getFiles()
    {
        return $this->provider->getFiles();
    }

}
