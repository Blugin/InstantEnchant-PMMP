<?php

/*
 *
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License. see <https://opensource.org/licenses/MIT>.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://opensource.org/licenses/MIT MIT License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace kim\present\instantenchant\utils;

use pocketmine\item\Item;

abstract class Material{
	public const NONE = -1;
	public const WOOD = 0;
	public const LEATHER = 1;
	public const STONE = 2;
	public const IRON = 3;
	public const CHAIN = 4;
	public const GOLD = 5;
	public const DIAMOND = 6;

	/**
	 * @var int[] const of selfs
	 *             key is item id
	 */
	public static $table = [
		//Wood
		Item::WOODEN_SWORD => self::WOOD,
		Item::WOODEN_SHOVEL => self::WOOD,
		Item::WOODEN_PICKAXE => self::WOOD,
		Item::WOODEN_AXE => self::WOOD,

		//Leather
		Item::LEATHER_HELMET => self::LEATHER,
		Item::LEATHER_CHESTPLATE => self::LEATHER,
		Item::LEATHER_LEGGINGS => self::LEATHER,
		Item::LEATHER_BOOTS => self::LEATHER,

		//Stone
		Item::STONE_SWORD => self::STONE,
		Item::STONE_SHOVEL => self::STONE,
		Item::STONE_PICKAXE => self::STONE,
		Item::STONE_AXE => self::STONE,

		//Iron
		Item::IRON_SWORD => self::IRON,
		Item::IRON_SHOVEL => self::IRON,
		Item::IRON_PICKAXE => self::IRON,
		Item::IRON_AXE => self::IRON,
		Item::IRON_HELMET => self::IRON,
		Item::IRON_CHESTPLATE => self::IRON,
		Item::IRON_LEGGINGS => self::IRON,
		Item::IRON_BOOTS => self::IRON,

		//Chain
		Item::CHAIN_HELMET => self::CHAIN,
		Item::CHAIN_CHESTPLATE => self::CHAIN,
		Item::CHAIN_LEGGINGS => self::CHAIN,
		Item::CHAIN_BOOTS => self::CHAIN,

		//Gold
		Item::GOLD_SWORD => self::GOLD,
		Item::GOLD_SHOVEL => self::GOLD,
		Item::GOLD_PICKAXE => self::GOLD,
		Item::GOLD_AXE => self::GOLD,
		Item::GOLD_HELMET => self::GOLD,
		Item::GOLD_CHESTPLATE => self::GOLD,
		Item::GOLD_LEGGINGS => self::GOLD,
		Item::GOLD_BOOTS => self::GOLD,

		//Diamond
		Item::DIAMOND_SWORD => self::DIAMOND,
		Item::DIAMOND_SHOVEL => self::DIAMOND,
		Item::DIAMOND_PICKAXE => self::DIAMOND,
		Item::DIAMOND_AXE => self::DIAMOND,
		Item::DIAMOND_HELMET => self::DIAMOND,
		Item::DIAMOND_CHESTPLATE => self::DIAMOND,
		Item::DIAMOND_LEGGINGS => self::DIAMOND,
		Item::DIAMOND_BOOTS => self::DIAMOND
	];

	/**
	 * @param Item $item
	 *
	 * @return int
	 */
	public static function get(Item $item) : int{
		return self::$table[$item->getId()] ?? self::NONE;
	}
}