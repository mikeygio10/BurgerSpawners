<?php


namespace Heisenburger69\BurgerSpawners\Entities;


use pocketmine\entity\Monster;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class ElderGuardian extends Monster {

    public const NETWORK_ID = self::ELDER_GUARDIAN;

    public $width = 1.9975;
    public $height = 1.9975;

    public function getName(): string{
        return "Elder Guardian";
    }

    public function getDrops(): array{
        $cause = $this->lastDamageCause;
        if($cause instanceof EntityDamageByEntityEvent){
            $dmg = $cause->getDamager();
            if($dmg instanceof Player){
                $looting = $dmg->getInventory()->getItemInHand()->getEnchantment(Enchantment::LOOTING);
                if($looting !== null){
                    $lootingL = $looting->getLevel();
                }else{
                    $lootingL = 1;
            }
            }
        }
        return [
            Item::get(Item::PRISMARINE_CRYSTALS, 0, mt_rand(0, 1 * $lootingL)),
            Item::get(Item::PRISMARINE_SHARD, 0, mt_rand(0, 2 * $lootingL)),
        ];
    }
}