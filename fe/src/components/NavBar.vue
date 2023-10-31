<template>
  <nav class="relative flex items-center justify-between p-4 lg:px-6">
    <div class="block flex-none md:hidden">
      <MobileMenu :menu="menu" />
    </div>
    <div class="flex w-full items-center">
      <div class="flex w-full md:w-1/3">
        <router-link
          to="/"
          class="mr-2 flex w-full items-center justify-center md:w-auto lg:mr-6"
        >
          <LogoSquare />
          <div
            class="ml-2 mr-2 flex-none text-sm font-medium uppercase md:hidden lg:block"
          >
            acme store
          </div>
        </router-link>
        <ul
          class="hidden gap-6 text-sm md:flex md:items-center"
          v-if="menu.length"
        >
          <li v-for="item in menu" :key="item.name">
            <router-link
              :to="item.href"
              class="text-neutral-500 underline-offset-4 hover:text-black hover:underline dark:text-neutral-400 dark:hover:text-neutral-300"
            >
              {{ item.name }}
            </router-link>
          </li>
        </ul>
      </div>
      <div class="hidden justify-center md:flex md:w-1/3">
        <SearchForm />
      </div>
      <div class="flex justify-end md:w-1/3">
        <Suspense>
          <!-- <Cart /> -->
          <button
            type="button"
            class="relative flex h-11 w-11 items-center justify-center rounded-md border border-neutral-200 text-black transition-colors dark:border-neutral-700 dark:text-white"
          >
            <span class="absolute -inset-1.5" />
            <span class="sr-only">View notifications</span>
            <ShoppingCartIcon
              class="h-4 transition-all ease-in-out hover:scale-110"
              aria-hidden="true"
            />
          </button>
        </Suspense>
      </div>
    </div>
  </nav>
</template>

<script>
import MobileMenu from "./MobileMenu.vue";
// import Search from "./search";
import SearchForm from "./SearchForm.vue";
// import LogoSquare from "components/logo-square";
import LogoSquare from "./LogoSquare.vue";
import { ShoppingCartIcon } from "@heroicons/vue/24/outline";

export default {
  // ... definisi komponen Navbar ...
  components: {
    MobileMenu,
    LogoSquare,
    SearchForm,
    ShoppingCartIcon,
  },
  data() {
    return {
      // menu: [], // Inisialisasi menu jika diperlukan
    };
  },
  computed: {
    menu() {
      return this.$router.options.routes
        .filter(
          (route) =>
            route.name != "/" &&
            route.name != "Sign In" &&
            route.name != "Add Product" &&
            route.name != "Sign Up" &&
            route.name != "Edit Product"
        )
        .map((route) => {
          return {
            name: route.name,
            href: route.path,
            current: this.$route.name === route.name,
          };
        });
    },
  },
  methods: {
    async getMenu() {
      // Simulate fetching the menu data, replace with your actual code.
      // const response = await fetchMenu(menuName);
      // return response.data;
    },
  },
};
</script>
