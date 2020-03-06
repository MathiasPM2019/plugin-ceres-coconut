<?php
namespace CeresCoconut\Contexts;

use IO\Helper\ContextInterface;
use Ceres\Contexts\SingleItemContext;

use IO\Services\ItemSearch\Services\ItemSearchService;
use IO\Services\ItemSearch\SearchPresets\CrossSellingItems;

class CrossSellingContext extends SingleItemContext implements ContextInterface
{
	public $accessory;
	public $similar;

	public function init($params)
	{
		parent::init($params);
		$options = array(
        			"itemId" => $this->item['documents'][0]['data']['item']['id'],
        			"relation" => "Accessory"      // Nutze die Liste Zubehoer
       		);
     		$searchfactory = CrossSellingItems::getSearchFactory( $options );
     		$searchfactory->setPage(1, 9); // Begrenze auf x Artikel
      		$result = pluginApp(ItemSearchService::class)->getResult($searchfactory);
      		$this->accessory = $result['documents'];
		$options = array(
        			"itemId" => $this->item['documents'][0]['data']['item']['id'],
        			"relation" => "Similar"      // Nutze die Liste Zubehoer
       		);
       	$searchfactory = CrossSellingItems::getSearchFactory( $options );
       	$searchfactory->setPage(1, 9); // Begrenze auf x Artikel
      		$result = pluginApp(ItemSearchService::class)->getResult($searchfactory);
      		$this->similar= $result['documents'];
	}
}
