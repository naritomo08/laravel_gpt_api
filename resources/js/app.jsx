import './bootstrap';

import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";

createInertiaApp({
  resolve: async name => {
    const pages = import.meta.glob("./Pages/**/*.jsx", { eager: true });
    const page = await pages[`./Pages/${name}.jsx`];
    console.log(name);
    return page.default;
  },
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />);
  }
});