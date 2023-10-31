<template>
  <div>
    <button
      @click="openMobileMenu"
      aria-label="Open mobile menu"
      class="flex h-11 w-11 items-center justify-center rounded-md border border-neutral-200 text-black transition-colors dark:border-neutral-700 dark:text-white md:hidden"
    >
      <Bars3Icon class="h-4" />
    </button>
    <Dialog
      v-model:open="isOpen"
      @close="closeMobileMenu"
      class="relative z-50"
      as="div"
    >
      <Transition
        enter-active-class="transition-all ease-in-out duration-300"
        enter-from-class="opacity-0 backdrop-blur-none"
        enter-to-class="opacity-100 backdrop-blur-[.5px]"
        leave-active-class="transition-all ease-in-out duration-200"
        leave-from-class="opacity-100 backdrop-blur-[.5px]"
        leave-to-class="opacity-0 backdrop-blur-none"
      >
        <div class="fixed inset-0 bg-black/30" aria-hidden="true" />
      </Transition>
      <Dialog.Panel
        class="fixed bottom-0 left-0 right-0 top-0 flex h-full w-full flex-col bg-white pb-6 dark:bg-black"
      >
        <div class="p-4">
          <button
            @click="closeMobileMenu"
            class="mb-4 flex h-11 w-11 items-center justify-center rounded-md border border-neutral-200 text-black transition-colors dark:border-neutral-700 dark:text-white"
            aria-label="Close mobile menu"
          >
            <XMarkIcon class="h-6" />
          </button>
          <div class="mb-4 w-full">
            <SearchForm />
          </div>
          <ul v-if="menu.length" class="flex w-full flex-col">
            <li
              v-for="item in menu"
              :key="item.name"
              class="py-2 text-xl text-black transition-colors hover:text-neutral-500 dark:text-white"
            >
              <router-link :to="item.href" @click="closeMobileMenu">{{
                item.name
              }}</router-link>
            </li>
          </ul>
        </div>
      </Dialog.Panel>
    </Dialog>
  </div>
</template>

<script>
import { ref } from "vue";
import { Dialog } from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";
import SearchForm from "./SearchForm.vue";
import { Transition } from "vue";

export default {
  components: {
    Dialog,
    Bars3Icon,
    XMarkIcon,
    SearchForm,
    Transition,
  },
  props: {
    menu: {
      type: Array,
      default: () => [],
    },
  },
  setup() {
    const isOpen = ref(false);

    const openMobileMenu = () => {
      isOpen.value = true;
    };

    const closeMobileMenu = () => {
      isOpen.value = false;
    };

    return {
      isOpen,
      openMobileMenu,
      closeMobileMenu,
    };
  },
};
</script>
