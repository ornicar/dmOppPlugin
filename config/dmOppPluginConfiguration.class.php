<?php

class dmOppPluginConfiguration extends sfPluginConfiguration
{
  public function configure()
  {
    $this->dispatcher->connect('dm.context.loaded', array($this,'listenToDmContextLoaded'));

    $this->dispatcher->connect('dm.content_chart.filter_modules', array($this, 'listenToContentChartFilterModulesEvent'));
  }

  public function listenToDmContextLoaded(sfEvent $e)
  {
    if($this->configuration instanceof dmAdminApplicationConfiguration)
    {
      $this->includeAssets($e->getSubject()->getResponse());
    }
  }

  public function listenToContentChartFilterModulesEvent(sfEvent $e, array $modules)
  {
    return $modules + array(
      'comCom', 'commune', 'site', 'photo'
    );
  }

  protected function includeAssets(sfWebResponse $response)
  {
    $response->addStylesheet('dmOppPlugin.admin');
  }
}