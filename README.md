# 🧪 **Laravel Assessment – Day 2: Product Catalog with Dynamic Alerts**

## 🧩 **General Context**

You need to develop an **autonomous and modular Laravel module** named `PkgProduit`, placed inside the `modules/` folder.

This module allows you to:

-   Manage a **product catalog** (name, price, stock).
-   Store **dynamic business rules** (saved in the database as expressions).
-   Evaluate these rules **dynamically using a `RuleEngine` class**.
-   Display only **alerted products** in a **dashboard widget**.

---

## 🛠️ **Mandatory Technical Constraint**

The project must follow a **modular Laravel architecture** with the following structure:

```
modules/
└── PkgProduit/
    ├── Controllers/
    ├── Models/
    ├── Views/
    ├── App/
    │   ├── Services/
    │   └── Requests/
    └── lang/
```

The module must be **declared via a custom Service Provider**.
All business logic must remain within the module.

---

## ❗️**Condition for Accessing the Next Section**

-   If you score **at least 4/5** in Section 1, you proceed.
-   Otherwise, you restart with a **new topic**. Your initial score (out of 5) remains, and the remaining parts will be graded out of 35.

---

## 🧾 Logical Data Model (LDM)

| Table        | Fields                                         |
| ------------ | ---------------------------------------------- |
| **produits** | id, name, stock, price, created_at, updated_at |
| **rules**    | id, label, expression (type `text`)            |

---

# 📁 **Section 1 – Prototype: Dynamic Rule Engine**

📖 _Documentation allowed_

### 🧮 Maximum Score: 5 points

### ⏱️ Duration: 30 minutes

### 🎯 Objective:

Implement a `RuleEngine` class capable of dynamically evaluating a business rule (expressed as text) against a product.

### 🔹 Tasks:

#### Q1.1 – Create a `RuleEngine` class with a method:

```php
public function evaluate(string $expression, array $data): bool
```

**(2 pts)**

#### Q1.2 – Simulate a product (e.g., `['stock' => 2, 'price' => 150]`), apply a rule (e.g., `stock < 5 && price > 100`), and display the result in a simple view.

**(3 pts)**

---

# 📁 **Section 2 – Creating & Paginated Display of Products**

### 🧮 Maximum Score: 10 points

### ⏱️ Duration: 1 hour

### 🎯 Objective:

Allow users to add products via an **AJAX modal form** and display stored products with **pagination**.

### 🔹 Tasks:

#### Q2.1 – Create the `Produit` model, its migration, and the controller within the module.

**(2 pts)**

#### Q2.2 – Create a view with an "Add Product" button → Opens a modal containing the form.

**(2 pts)**

#### Q2.3 – Submit the form via AJAX and display validation errors inside the modal.

**(3 pts)**

#### Q2.4 – Display products in a **paginated table (10 per page)**, sorted by creation date (descending).

**(3 pts)**

---

# 📁 **Section 3 – Dashboard with Dynamic Alert Widget**

### 🧮 Maximum Score: 25 points

### ⏱️ Duration: 1 hour 30 minutes

### 🎯 Objective:

Create a **responsive dashboard** with a **widget** displaying only **alerted products**—i.e., those that match **at least one business rule**.

### 🔹 Tasks:

#### Q3.1 – Create the `rules` table with a migration and model, and insert **at least two rules** (with explicit labels).

**(3 pts)**

#### Q3.2 – Implement an `AlertService` with a public method:

```php
public function getProduitsEnAlerte(): Collection
```

This method should:

-   Retrieve all products.
-   Retrieve all rules.
-   Dynamically apply each rule to each product using `RuleEngine`.
-   Return only the products for which **at least one rule evaluates to true**.
    **(8 pts)**

#### Q3.3 – Create a `dashboard.blade.php` view containing a **widget** (styled card or block) displaying the list of alerted products.

**(7 pts)**

#### Q3.4 – Handle all `RuleEngine` evaluation errors:

-   Invalid expressions (e.g., `stock => 5`).
-   Missing variables (`price`, `stock`, etc.).
-   Non-boolean results.
    Display clean error messages without breaking the interface.
    **(7 pts)**

#### Q3.5 – Ensure the dashboard interface is **responsive and works on both PC and mobile** (Bootstrap recommended).

**(2 pts)**

---

## ✅ **Grading Summary**

| Section   | Description                                  | Score   |
| --------- | -------------------------------------------- | ------- |
| Section 1 | Prototype – Dynamic Rule Engine              | /5      |
| Section 2 | Product Creation (AJAX + modal) + Pagination | /10     |
| Section 3 | Dashboard with Dynamic Alert Widget          | /25     |
| **Total** |                                              | **/40** |

---
