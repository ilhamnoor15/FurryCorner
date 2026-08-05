(function () {
  const STORAGE_KEYS = {
    products: 'furryCornerProducts',
    orders: 'furryCornerOrders',
    lastOrder: 'lastOrder'
  };

  const TODAY = new Date().toLocaleDateString('en-PH');

  const DEFAULT_PRODUCTS = [
    { id: 1, name: 'Kibble Dog Food', category: 'Food', subcategory:'Dry Food',price: 760, stock: 50, status: 'In Stock', dateUpdated: TODAY },
    { id: 2, name: 'Air-Dried Dog Food', category: 'Food', subcategory:'Dry Food', price: 741.16, stock: 40, status: 'In Stock', dateUpdated: TODAY },
    { id: 3, name: 'Freeze-Dried Dog Food', category: 'Food',subcategory:'Dry Food', price: 149, stock: 6, status: 'Low Stock', dateUpdated: TODAY },
    { id: 4, name: 'Baked Dog Treat', category: 'Food', subcategory:'Dry Food', price: 239, stock: 30, status: 'In Stock', dateUpdated: TODAY },
    { id: 5, name: 'Frozen Pet Food', category: 'Food', subcategory:'Dry Food', price: 169, stock: 25, status: 'In Stock', dateUpdated: TODAY },
    { id: 6, name: 'Canned Wet Food', category: 'Food', subcategory:'Wet Food', price: 180, stock: 4, status: 'Low Stock', dateUpdated: TODAY },
    { id: 7, name: 'Poultry Wet Food', category: 'Food', subcategory:'Wet Food', price: 39, stock: 60, status: 'In Stock', dateUpdated: TODAY },
    { id: 8, name: 'Fish Wet Food', category: 'Food', subcategory:'Wet Food', price: 35, stock: 60, status: 'In Stock', dateUpdated: TODAY },
    { id: 9, name: 'Meat Wet Food', category: 'Food', subcategory:'Wet Food', price: 59, stock: 40, status: 'In Stock', dateUpdated: TODAY },
    { id: 10, name: 'Diet Dog Food', category: 'Food', subcategory:'Wet Food', price: 489, stock: 20, status: 'In Stock', dateUpdated: TODAY },
    { id: 11, name: 'Pastry Treat', category: 'Food', subcategory: 'Treats', price: 398, stock: 8, status: 'Low Stock', dateUpdated: TODAY },
    { id: 12, name: 'Dental Stix', category: 'Food', subcategory: 'Treats', price: 219, stock: 35, status: 'In Stock', dateUpdated: TODAY },
    { id: 13, name: 'Protein Treat', category: 'Food', subcategory: 'Treats',  price: 130, stock: 45, status: 'In Stock', dateUpdated: TODAY },
    { id: 14, name: 'Training Treat', category: 'Food', subcategory: 'Treats', price: 129, stock: 50, status: 'In Stock', dateUpdated: TODAY },
    { id: 15, name: 'Chewy Treat', category: 'Food', subcategory: 'Treats', price: 239, stock: 28, status: 'In Stock', dateUpdated: TODAY },
    { id: 16, name: 'Harness', category: 'Accessories', subcategory: 'Walking Essentials', price: 350, stock: 45, status: 'In Stock', dateUpdated: TODAY },
    { id: 17, name: 'Collar', category: 'Accessories', subcategory: 'Walking Essentials', price: 180, stock: 50, status: 'In Stock', dateUpdated: TODAY },
    { id: 18, name: 'Leash', category: 'Accessories', subcategory: 'Walking Essentials', price: 250, stock: 0, status: 'Out of Stock', dateUpdated: TODAY },
    { id: 19, name: 'Pet Shoes', category: 'Accessories', subcategory: 'Walking Essentials', price: 450, stock: 15, status: 'In Stock', dateUpdated: TODAY },
    { id: 20, name: 'Pet Stroller', category: 'Accessories', subcategory: 'Walking Essentials', price: 2300, stock: 5, status: 'Low Stock', dateUpdated: TODAY },
    { id: 21, name: 'Pet Bed', category: 'Accessories', subcategory: 'Home Gear', price: 850, stock: 5, status: 'Low Stock', dateUpdated: TODAY },
    { id: 22, name: 'Pet Cage', category: 'Accessories', subcategory: 'Home Gear', price: 1500, stock: 3, status: 'Low Stock', dateUpdated: TODAY },
    { id: 23, name: 'Food & Water Bowl', category: 'Accessories', subcategory: 'Home Gear', price: 250, stock: 40, status: 'In Stock', dateUpdated: TODAY },
    { id: 24, name: 'Potty Pads', category: 'Accessories', subcategory: 'Home Gear', price: 450, stock: 22, status: 'In Stock', dateUpdated: TODAY },
    { id: 25, name: 'Brush / Comb', category: 'Accessories', subcategory:'Home Gear', price: 220, stock: 35, status: 'In Stock', dateUpdated: TODAY },
    { id: 26, name: 'Plush Toy', category: 'Accessories', subcategory: 'Toys', price: 180, stock: 50, status: 'In Stock', dateUpdated: TODAY },
    { id: 27, name: 'Squeaky Toy', category: 'Accessories', subcategory: 'Toys', price: 150, stock: 40, status: 'In Stock', dateUpdated: TODAY },
    { id: 28, name: 'Ball Toy', category: 'Accessories', subcategory: 'Toys', price: 150, stock: 40, status: 'In Stock', dateUpdated: TODAY },
    { id: 29, name: 'Chew Toy', category: 'Accessories', subcategory: 'Toys', price: 200, stock: 30, status: 'In Stock', dateUpdated: TODAY },
    { id: 30, name: 'Interactive Toy', category: 'Accessories', subcategory:'Toys', price: 150, stock: 25, status: 'In Stock', dateUpdated: TODAY }
  ];

  const DEFAULT_SERVICES = [
    { id: 'groom-1', category: 'Grooming', name: 'Tooth Brushing', price: '100', duration: '15 min', status: 'Active' },
    { id: 'groom-2', category: 'Grooming', name: 'Haircut', price: '350 - 750', duration: '1-2 hrs', status: 'Active' },
    { id: 'groom-3', category: 'Grooming', name: 'Bath', price: '700 - 2,000', duration: '1-2 hrs', status: 'Active' },
    { id: 'groom-4', category: 'Grooming', name: 'Nail Care', price: '100', duration: '15 min', status: 'Active' },
    { id: 'groom-5', category: 'Grooming', name: 'Ear Cleaning', price: '100', duration: '15 min', status: 'Active' },
    { id: 'care-1', category: 'Care', name: 'Dental', price: '300 - 3,000', duration: 'Varies', status: 'Active' },
    { id: 'care-2', category: 'Care', name: 'Prescription / Consultation', price: '500', duration: '30 min', status: 'Active' },
    { id: 'care-3', category: 'Care', name: 'Vaccination', price: '350 - 4,500', duration: 'Varies', status: 'Active' },
    { id: 'care-4', category: 'Care', name: 'Spaying', price: '1,000 - 2,500', duration: 'Varies', status: 'Inactive' },
    { id: 'care-5', category: 'Care', name: 'Medicine', price: '99 - 1,000', duration: 'Varies', status: 'Active' },
    { id: 'board-1', category: 'Boarding', name: 'Fostering', price: 'Free', duration: 'Varies', status: 'Active' },
    { id: 'board-2', category: 'Boarding', name: 'Day Boarding', price: '350 - 695 / day', duration: 'Daily', status: 'Active' },
    { id: 'board-3', category: 'Boarding', name: 'Spa / Leisure', price: '350 - 850', duration: 'Varies', status: 'Active' },
    { id: 'board-4', category: 'Boarding', name: 'Veterinary Boarding', price: '450 - 850 / day', duration: 'Daily', status: 'Active' },
    { id: 'board-5', category: 'Boarding', name: 'Overnight Boarding', price: '450 - 899', duration: 'Nightly', status: 'Active' }
  ];

  function readStorage(key, fallback) {
    try {
      const saved = localStorage.getItem(key);
      return saved ? JSON.parse(saved) : fallback;
    } catch (error) {
      console.warn('Unable to read storage:', error);
      return fallback;
    }
  }

  function writeStorage(key, value) {
    try {
      localStorage.setItem(key, JSON.stringify(value));
    } catch (error) {
      console.warn('Unable to write storage:', error);
    }
  }

  function dedupeProducts(products) {
    const unique = new Map();
    products.forEach((product) => {
      const id = Number(product.id);
      if (!Number.isNaN(id) && !unique.has(id)) {
        unique.set(id, product);
      }
    });
    return Array.from(unique.values()).sort((a, b) => Number(a.id) - Number(b.id));
  }

  function mergeProductsWithDefaults(products) {
    const storedById = new Map();
    products.forEach((product) => {
      const id = Number(product.id);
      if (!Number.isNaN(id) && !storedById.has(id)) {
        storedById.set(id, product);
      }
    });

    const merged = DEFAULT_PRODUCTS.map((defaultProduct) => {
      const id = Number(defaultProduct.id);
      const stored = storedById.get(id);
      if (!stored) {
        return defaultProduct;
      }
      return {
        ...defaultProduct,
        stock: Number(stored.stock ?? defaultProduct.stock),
        status: stored.status || defaultProduct.status,
        dateUpdated: stored.dateUpdated || defaultProduct.dateUpdated
      };
    });

    products.forEach((product) => {
      const id = Number(product.id);
      if (!Number.isNaN(id) && !DEFAULT_PRODUCTS.some((defaultProduct) => Number(defaultProduct.id) === id)) {
        merged.push(product);
      }
    });

    return dedupeProducts(merged);
  }

  function getProducts() {
    const products = readStorage(STORAGE_KEYS.products, null);

    if (!Array.isArray(products)) {
        writeStorage(STORAGE_KEYS.products, DEFAULT_PRODUCTS);
        return [...DEFAULT_PRODUCTS];
    }

    return products;
}

  function saveProducts(products) {
    writeStorage(STORAGE_KEYS.products, products);
    return products;
}

  function getOrders() {
    const orders = readStorage(STORAGE_KEYS.orders, []);
    return Array.isArray(orders) ? orders : [];
  }

  function getServices() {
    const services = readStorage('furryCornerServices', null);
    if (!Array.isArray(services)) {
      writeStorage('furryCornerServices', DEFAULT_SERVICES);
      return DEFAULT_SERVICES;
    }
    return services;
  }

  function saveServices(services) {
    writeStorage('furryCornerServices', services);
    return services;
  }

  function saveOrders(orders) {
    writeStorage(STORAGE_KEYS.orders, orders);
    return orders;
  }

  function addOrder(order) {
    const orders = getOrders();
    const normalizedOrder = {
      ...order,
      orderId: order.orderId || `#CF${Date.now().toString().slice(-5)}`,
      status: order.status || 'Processing'
    };
    orders.unshift(normalizedOrder);
    saveOrders(orders);
    writeStorage(STORAGE_KEYS.lastOrder, normalizedOrder);
    return normalizedOrder;
  }

  function deductStock(items) {
    const products = getProducts();
    const insufficient = [];
    const updatedProducts = products.map((product) => {
      const item = Array.isArray(items)
        ? items.find((entry) => Number(entry.id) === Number(product.id))
        : null;

      if (!item) {
        return product;
      }

      const available = Number(product.stock || 0);
      const requested = Number(item.quantity || 0);

      if (available < requested) {
        insufficient.push(product.name);
        return product;
      }

      return {
        ...product,
        stock: available - requested,
        status: available - requested <= 0 ? 'Out of Stock' : available - requested <= 5 ? 'Low Stock' : 'In Stock'
      };
    });

    if (insufficient.length) {
      return { ok: false, insufficient };
    }

    saveProducts(updatedProducts);
    return { ok: true, products: updatedProducts };
  }

  function getAdminSummary() {
    const products = getProducts();
    const services = getServices();
    const orders = getOrders();

    return {
        productCount: products.length,
        serviceCount: services.length,
        orderCount: orders.length,
        lowStockCount: products.filter(product => Number(product.stock || 0) <= 5).length
    };
}

  function getStatusFromStock(stock) {
    const value = Number(stock || 0);
    if (value <= 0) return 'Out of Stock';
    if (value <= 5) return 'Low Stock';
    return 'In Stock';
  }

  function formatPrice(value) {
    return '₱' + Number(value).toLocaleString('en-PH', {
        minimumFractionDigits: 2
    });
}

  window.FurryCornerStorage = {
    STORAGE_KEYS,
    getProducts,
    saveProducts,
    getOrders,
    saveOrders,
    addOrder,
    deductStock,
    getAdminSummary,
    getStatusFromStock,
    formatPrice,
    getServices,
    saveServices
  };

  (function importDefaultsIfMissing() {
    try {
        const storedProducts = readStorage(STORAGE_KEYS.products, null);

        // Only create the default products once
        if (!Array.isArray(storedProducts)) {
            writeStorage(STORAGE_KEYS.products, DEFAULT_PRODUCTS);
        }

        const storedServices = readStorage('furryCornerServices', null);

        if (!Array.isArray(storedServices)) {
            writeStorage('furryCornerServices', DEFAULT_SERVICES);
        }

    } catch (e) {
        console.warn('Error importing defaults:', e);
    }
})();

window.readStorage = readStorage;
window.DEFAULT_SERVICES = DEFAULT_SERVICES;

})();
