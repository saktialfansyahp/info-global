<template>
  <div
    :class="[
      'flex flex-none items-center justify-center border border-neutral-200 bg-white dark:border-neutral-700 dark:bg-black',
      sizeClasses,
    ]"
  >
    <LogoIcon :class="iconClasses" />
  </div>
</template>

<script>
import clsx from "clsx";
// import LogoIcon from "./icons/logo.vue"; // Pastikan Anda mengimpor komponen LogoIcon dengan ekstensi .vue
import LogoIcon from "./LogoIcon.vue";

export default {
  props: {
    size: {
      type: String,
      default: "sm", // Ganti nilai default sesuai kebutuhan
    },
  },
  components: {
    LogoIcon,
  },
  computed: {
    sizeClasses() {
      return clsx({
        "h-[40px] w-[40px] rounded-xl": this.size !== "sm",
        "h-[30px] w-[30px] rounded-lg": this.size === "sm",
      });
    },
    iconClasses() {
      return clsx({
        "h-[16px] w-[16px]": this.size !== "sm",
        "h-[10px] w-[10px]": this.size === "sm",
      });
    },
  },
};
</script>
