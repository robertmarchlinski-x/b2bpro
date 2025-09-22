# B2B Pro - plugin skeleton

To jest szkielet wtyczki B2B Pro (WooCommerce). Zawiera:
- prosty autoloader PSR-4 fallback
- migracje dbDelta w aktywacji wtyczki
- przykładowe REST endpointy (b2bp/v1/ping)
- stub PriceResolver i admin page
- assets frontend (Alpine.js) + Vite config

Instalacja:
1. skopiuj cały katalog `b2b-pro` do `wp-content/plugins/`
2. (opcjonalnie) uruchom `composer install` w katalogu wtyczki
3. `npm install` i `npm run build` aby zbudować assets
4. włącz wtyczkę w WP Admin -> Wtyczki
