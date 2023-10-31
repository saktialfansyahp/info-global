import { createRouter, createWebHashHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import SignIn from "../views/SignIn.vue";
import SignUp from "../views/SignUp.vue";
import ProductView from "../views/ProductView.vue";
import AddProductView from "../views/adminpage/AddProductView.vue";
import EditProductView from "../views/adminpage/EditProductView.vue";
import ColorView from "../views/ColorView.vue";
import AddColorView from "../views/adminpage/AddColorView.vue";
import EditColorView from "../views/adminpage/EditColorView.vue";
import CategoryView from "../views/CategoryView.vue";
import AddCategoryView from "../views/adminpage/AddCategoryView.vue";
import EditCategoryView from "../views/adminpage/EditCategoryView.vue";
import SubcategoryView from "../views/SubcategoryView.vue";
import AddSubcategoryView from "../views/adminpage/AddSubcategoryView.vue";
import EditSubcategoryView from "../views/adminpage/EditSubcategoryView.vue";
import store from "../store";
import jwt_decode from "jwt-decode";
import TryView from "../views/TryView.vue";
// import AdminView from "../views/AdminView.vue";
// import UserView from "../views/UserView.vue";

const routes = [
  {
    path: "/",
    name: "/",
    redirect: "/home",
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: "/signin",
    name: "Sign In",
    component: SignIn,
  },
  {
    path: "/try",
    name: "Try",
    component: TryView,
  },
  {
    path: "/signup",
    name: "Sign Up",
    component: SignUp,
  },
  {
    path: "/home",
    name: "Home",
    component: HomeView,
    meta: {
      breadcrumb: "Home",
      requiresAuth: true,
    },
  },
  {
    path: "/product",
    name: "Product",
    component: ProductView,
    meta: {
      breadcrumb: "About",
      requiresAuth: true,
    },
  },
  {
    path: "/product/addproduct",
    name: "Add Product",
    component: AddProductView,
    meta: {
      breadcrumb: "Add Product",
      requiresAuth: true,
    },
  },
  {
    path: "/product/editproduct/:id",
    name: "Edit Product",
    component: EditProductView,
    meta: {
      breadcrumb: "Edit Product",
      requiresAuth: true,
    },
  },
  {
    path: "/color",
    name: "Color",
    component: ColorView,
    meta: {
      breadcrumb: "Color",
      requiresAuth: true,
    },
  },
  {
    path: "/color/addcolor",
    name: "Add Color",
    component: AddColorView,
    meta: {
      breadcrumb: "Add Color",
      requiresAuth: true,
    },
  },
  {
    path: "/color/editcolor/:id",
    name: "Edit Color",
    component: EditColorView,
    meta: {
      breadcrumb: "Edit Color",
      requiresAuth: true,
    },
  },
  {
    path: "/category",
    name: "Category",
    component: CategoryView,
    meta: {
      breadcrumb: "Category",
      requiresAuth: true,
    },
  },
  {
    path: "/category/addcategory",
    name: "Add Category",
    component: AddCategoryView,
    meta: {
      breadcrumb: "Add Category",
      requiresAuth: true,
    },
  },
  {
    path: "/category/editcategory/:id",
    name: "Edit Category",
    component: EditCategoryView,
    meta: {
      breadcrumb: "Edit Category",
      requiresAuth: true,
    },
  },
  {
    path: "/subcategory",
    name: "Subcategory",
    component: SubcategoryView,
    meta: {
      breadcrumb: "Subcategory",
      requiresAuth: true,
    },
  },
  {
    path: "/subcategory/addsubcategory",
    name: "Add Subcategory",
    component: AddSubcategoryView,
    meta: {
      breadcrumb: "Add Subcategory",
      requiresAuth: true,
    },
  },
  {
    path: "/subcategory/editsubcategory/:id",
    name: "Edit Subcategory",
    component: EditSubcategoryView,
    meta: {
      breadcrumb: "Edit Subcategory",
      requiresAuth: true,
    },
  },
  // {
  //   path: "/admin",
  //   name: "Admin",
  //   component: AdminView,
  //   meta: { requiresAdmin: true }, // Menandai rute yang memerlukan hak admin
  // },
  // {
  //   path: "/user",
  //   name: "User",
  //   component: UserView,
  //   meta: { requiresUser: true }, // Menandai rute yang memerlukan hak user
  // },
];

const router = createRouter({
  history: createWebHashHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
  const requiresAdmin = to.matched.some((record) => record.meta.requiresAdmin);
  const requiresUser = to.matched.some((record) => record.meta.requiresUser);

  if (requiresAuth && !store.state.isLoggedIn && store.state.role == null) {
    if (to.name !== "signin") {
      next("/signin");
    } else {
      next();
    }
  } else if (requiresAdmin && store.state.role === "admin") {
    next();
  } else if (requiresUser && store.state.role === "user") {
    next();
  } else {
    next();
  }
  const token = localStorage.getItem("token");
  const decodedToken = jwt_decode(token);
  const expirationDate = new Date(decodedToken.exp * 1000);
  if (expirationDate <= new Date()) {
    // localStorage.removeItem('access_token');
    // localStorage.removeItem('user');
    localStorage.clear();
    this.$router.push("/signin");
  } else {
    next();
  }
});
// router.beforeEach((to, from, next) => {
//   // const token = localStorage.getItem("access_token");
//   // const user = localStorage.getItem("user");
//   if (
//     to.matched.some((record) => record.meta.requiresAuth) &&
//     store.state.role == "" &&
//     store.state.isLoggedIn == false
//   ) {
//     // Jika rute yang dituju memerlukan otentikasi dan tidak ada akses token,
//     // maka batalkan navigasi dan arahkan ke halaman login
//     next("/signin");
//   } else {
//     // Jika akses token ada atau rute yang dituju tidak memerlukan otentikasi,
//     // maka izinkan navigasi ke rute yang dituju
//     next();
//   }

//   // const decodedToken = jwt_decode(token);
//   // const expirationDate = new Date(decodedToken.exp * 1000);
//   // if (expirationDate <= new Date()) {
//   //   // localStorage.removeItem('access_token');
//   //   // localStorage.removeItem('user');
//   //   localStorage.clear();
//   //   this.$router.push("/signin");
//   // } else {
//   //   next();
//   // }
// });
export default router;
