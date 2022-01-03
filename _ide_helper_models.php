<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Api
 *
 * @property int $id
 * @property int $user_id
 * @property string $api_key
 * @property string $secret_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Api newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Api newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Api query()
 * @method static \Illuminate\Database\Eloquent\Builder|Api whereApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Api whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Api whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Api whereSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Api whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Api whereUserId($value)
 */
	class Api extends \Eloquent {}
}

namespace App\Models\Backtest{
/**
 * App\Models\Backtest\Backtest
 *
 * @property int $id
 * @property int $user_id
 * @property string $pair
 * @property string $amount
 * @property string $time_buy
 * @property string $price_buy
 * @property string|null $price_sell
 * @property string|null $time_sell
 * @property string|null $profit
 * @property string $status
 * @property string $via
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Backtest\BacktestBalance|null $balance
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest query()
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest wherePair($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest wherePriceBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest wherePriceSell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest whereTimeBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest whereTimeSell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backtest whereVia($value)
 */
	class Backtest extends \Eloquent {}
}

namespace App\Models\Backtest{
/**
 * App\Models\Backtest\BacktestBalance
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Backtest\Backtest $backtest
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\Backtest\BacktestBalanceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|BacktestBalance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BacktestBalance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BacktestBalance query()
 * @method static \Illuminate\Database\Eloquent\Builder|BacktestBalance whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacktestBalance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacktestBalance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacktestBalance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BacktestBalance whereUserId($value)
 */
	class BacktestBalance extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Balance
 *
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Balance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Balance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Balance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Balance whereUserId($value)
 */
	class Balance extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Coin
 *
 * @property int $id
 * @property string $ticker_id
 * @property string $desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Coin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coin whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coin whereTickerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coin whereUpdatedAt($value)
 */
	class Coin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Menu[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MenuItem
 *
 * @property int $id
 * @property int $menu_id
 * @property int $child_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereChildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereUpdatedAt($value)
 */
	class MenuItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property string $coin
 * @property int $amount
 * @property int $price_buy
 * @property int $price_sell
 * @property string $profit
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $indodax_id
 * @property string|null $type
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\OrderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIndodaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePriceBuy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePriceSell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Signal
 *
 * @property int $id
 * @property string $macd_value
 * @property string $macd_signal
 * @property string $macd_hist
 * @property int $macd_crossover
 * @property string $rsi_value
 * @property string|null $stoch_k
 * @property string|null $stoch_d
 * @property string $market_price
 * @property string $coin_name
 * @property string|null $via
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SignalFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Signal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Signal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereCoinName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereMacdCrossover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereMacdHist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereMacdSignal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereMacdValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereMarketPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereRsiValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereStochD($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereStochK($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signal whereVia($value)
 */
	class Signal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Api|null $api
 * @property-read \App\Models\Backtest\Backtest|null $backtest
 * @property-read \App\Models\Backtest\BacktestBalance|null $backtestBalance
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Balance[] $balance
 * @property-read int|null $balance_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $pendingOrder
 * @property-read int|null $pending_order_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\UserSetting|null $setting
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSetting
 *
 * @property int $id
 * @property int $user_id
 * @property string $take_profit
 * @property string $stop_loss
 * @property int $amount_trade
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserSettingFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereAmountTrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereStopLoss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereTakeProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereUserId($value)
 */
	class UserSetting extends \Eloquent {}
}

