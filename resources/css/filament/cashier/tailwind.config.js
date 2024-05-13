import preset from "../../../../vendor/filament/filament/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Filament/Cashier/**/*.php",
        "./resources/views/filament/cashier/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/awcodes/filament-table-repeater/resources/**/*.blade.php",
    ],
};
