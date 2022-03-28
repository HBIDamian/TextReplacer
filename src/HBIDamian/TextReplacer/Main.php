<?php
namespace HBIDamian\TextReplacer;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->getCommandsConfig = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onChat(PlayerChatEvent $event): void{
        $commandsConfig = $this->getCommandsConfig()->getAll();
        foreach ($commandsConfig["TextReplacer"] as $var){
            $message = str_replace($var["Before"], $var["After"], $event->getMessage());
            $event->setMessage($message);
        }
    }

    public function getCommandsConfig(){
        return $this->getCommandsConfig;
    }
}
