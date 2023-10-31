<template>
  <form
    @submit="onSubmit"
    class="w-max-[550px] relative w-full lg:w-80 xl:w-full"
  >
    <input
      :key="searchQuery"
      type="text"
      name="search"
      placeholder="Search for products..."
      autoComplete="off"
      v-model="searchQuery"
      class="w-full rounded-lg border bg-white px-4 py-2 text-sm text-black placeholder:text-neutral-500 dark:border-neutral-800 dark:bg-transparent dark:text-white dark:placeholder:text-neutral-400"
    />
    <div class="absolute right-0 top-0 mr-3 flex h-full items-center">
      <MagnifyingGlassIcon class="h-4" />
    </div>
  </form>
</template>

<script>
import { ref, watch } from "vue";
import { useRouter } from "vue-router";
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid";

export default {
  components: {
    MagnifyingGlassIcon,
  },
  setup() {
    const router = useRouter();
    const searchQuery = ref("");

    const onSubmit = (e) => {
      e.preventDefault();

      const newParams = new URLSearchParams(
        router.currentRoute.value.query.toString()
      );

      if (searchQuery.value) {
        newParams.set("q", searchQuery.value);
      } else {
        newParams.delete("q");
      }
    };

    watch(
      () => searchQuery.value,
      (newVal, oldVal) => {
        if (newVal !== oldVal) {
          onSubmit({ preventDefault: () => {} }); // Simulasikan onSubmit ketika searchQuery berubah
        }
      }
    );

    return {
      onSubmit,
    };
  },
};
</script>
