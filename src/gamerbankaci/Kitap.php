<?php

namespace gamerbankaci;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;
use pocketmine\item\WrittenBook;
use pocketmine\item\Item;

class Kitap extends PluginBase implements Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§aEklenti Aktif Edildi!");
	}
	
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
		$player = $sender->getPlayer();
		switch($command->getName()){
			case "kitap":
			$this->menuForm($player);
		}
		return true;
	}
	
	public function menuForm($player){
		if($player instanceof Player){
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
			$form = $api->createSimpleForm(function (Player $sender, array $data){
				if(isset($data[0])){
					switch($data[0]){
						case 0:
						$sender->sendMessage("§7»§4Yardım Kitabı Alındı!");
        $item = Item::get(Item::WRITTEN_BOOK, 0, 1);
        $item->setTitle(C::GREEN.C::UNDERLINE."Yardım Kitabı");
        $item->setPageText(0, C::GREEN.C::UNDERLINE."Yardım Kitabı".C::BLACK."\n - DENEME1!\n - \n - DENEME!");
        $item->setAuthor("Sunucu");
        $sender->getInventory()->addItem($item);
             break;
						case 1:
						$sender->sendMessage("§7»§aTeam Kitabı Alındı!");
        $item = Item::get(Item::WRITTEN_BOOK, 0, 1);
        $item->setTitle(C::GREEN.C::UNDERLINE."Team Kitabı");
        $item->setPageText(0, C::GREEN.C::UNDERLINE."Team Kitabı".C::BLACK."\n - DENEME!\n - \n - DENEME!");
        $item->setAuthor("Sunucu");
        $sender->getInventory()->addItem($item);
            break;
					case 2:
						$sender->sendMessage("§7»§bKurallar Kitabı Alındı!");
        $item = Item::get(Item::WRITTEN_BOOK, 0, 1);
        $item->setTitle(C::GREEN.C::UNDERLINE."Kurallar Kitabı");
        $item->setPageText(0, C::GREEN.C::UNDERLINE."Kurallar Kitabı".C::BLACK."\n - DENEME!\n - \n - DENEME");
        $item->setAuthor("Sunucu");
        $sender->getInventory()->addItem($item);
        break;
                case 3:
                $sender->sendMessage("§2Çıkış Yaptınız.");
					}
					
				}
			});
			$form->setTitle("§aKitap Menüsü");
      $form->setContent("§7Burdan Kitap Seçip Bilgi Alabilirsiniz!");
			$form->addButton("§cYardım Kitabı!");
      $form->addButton("§aTeam Kitabı!");
      $form->addButton("§bKurallar Kitabı!");
			$form->addButton("§4Çıkış");
		
			$form->sendToPlayer($player);			
		}else{
			$sender->sendMessage("§cBu Komutu Lütfen Oyundayken Kullanınız!");
			return true;
		}
	}
}