<template>
    <button
        type="button"
        class="menu-item"
        :class="{ 'is-active': isActive ? isActive() : null }"
        @click="action"
        :title="title"
    >
        <!-- <svg class="remix">
            <use :xlink:href="`${remixiconUrl}#ri-${icon}`"/>
        </svg> -->
        <v-icon class="icon-richtext">mdi-{{icon}}</v-icon>
    </button>
</template>

<script>
export default {
    data() {
        return {};
    },

    props: {
        icon: {
            type: String,
            required: true,
        },

        title: {
            type: String,
            required: true,
        },

        action: {
            type: Function,
            required: true,
        },

        isActive: {
            type: Function,
            default: null,
        },
    },
};
</script>

<style>
.menu-item {
    width: 1.75rem;
    height: 1.75rem;
    border: none;
    background-color: transparent;
    border-radius: 0.4rem;
    padding: 0.25rem;
    margin-right: 0.25rem;
}
.menu-item .icon-richtext {
    width: 100%;
    height: 100%;
    margin-top: -2px;
    font-size: 20px;
}
.menu-item.is-active,
.menu-item:hover {
    background-color: var(--orange-color);
}
.menu-item.is-active .icon-richtext,
.menu-item:hover .icon-richtext {
    color: #fff;
}
</style>
