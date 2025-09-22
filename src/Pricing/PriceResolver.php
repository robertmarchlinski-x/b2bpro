<?php
namespace B2BP\Pricing;

/**
 * PriceResolver - stub
 *
 * Responsible for resolving price for product/variation/role/quantity.
 * Integrate with WooCommerce price filters in next steps.
 */
class PriceResolver {
    /**
     * Resolve price (stub)
     *
     * @param int $product_id
     * @param int|null $variation_id
     * @param string|null $role
     * @param float $qty
     * @return float|null returns null when no B2B price applies
     */
    public function resolve( $product_id, $variation_id = null, $role = null, $qty = 1 ) {
        // TODO: implement lookup in price_rules + price_tiers tables
        return null;
    }
}
