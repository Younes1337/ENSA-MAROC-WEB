<template>
    <div class="pa-4 customized-input">
        <div v-if="editor">
            <menu-bar class="editor__header" :editor="editor" />
            <bubble-menu
                class="bubble-menu"
                :tippy-options="{ duration: 100 }"
                :editor="editor"
            >
                <button
                    type="button"
                    @click="editor.chain().focus().toggleBold().run()"
                    :class="{ 'is-active': editor.isActive('bold') }"
                >
                    Bold
                </button>
                <button
                    type="button"
                    @click="editor.chain().focus().toggleItalic().run()"
                    :class="{ 'is-active': editor.isActive('italic') }"
                >
                    Italic
                </button>
                <button
                    type="button"
                    @click="editor.chain().focus().toggleStrike().run()"
                    :class="{ 'is-active': editor.isActive('strike') }"
                >
                    Strike
                </button>
            </bubble-menu>
        </div>
        <editor-content :editor="editor" />
        <div class="character-count text-right" v-if="editor">
            {{ editor.storage.characterCount.characters() }}/{{ limit }}
            {{ $t("others.characters") }}
            <br />
            {{ editor.storage.characterCount.words() }} {{ $t("others.words") }}
        </div>
    </div>
</template>

<script>
import { Editor, EditorContent, BubbleMenu } from "@tiptap/vue-2";
import StarterKit from "@tiptap/starter-kit";
import MenuBar from "./MenuBar.vue";

import Document from "@tiptap/extension-document";
import Paragraph from "@tiptap/extension-paragraph";
import Text from "@tiptap/extension-text";
import TextAlign from "@tiptap/extension-text-align";
import Image from "@tiptap/extension-image";
import Dropcursor from "@tiptap/extension-dropcursor";
import Highlight from "@tiptap/extension-highlight";
import Link from "@tiptap/extension-link";
import TextStyle from "@tiptap/extension-text-style";
import { Color } from "@tiptap/extension-color";
import CharacterCount from "@tiptap/extension-character-count";
import CodeBlockLowlight from "@tiptap/extension-code-block-lowlight";
import lowlight from "lowlight";
import Placeholder from "@tiptap/extension-placeholder";
import Table from "@tiptap/extension-table";
import TableRow from "@tiptap/extension-table-row";
import TableCell from "@tiptap/extension-table-cell";
import TableHeader from "@tiptap/extension-table-header";

export default {
    components: {
        EditorContent,
        BubbleMenu,
        MenuBar,
    },

    data() {
        return {
            editor: null,
            limit: 500000,
        };
    },

    props: {
        value: {
            type: String,
            default: "",
        },
    },

    mounted() {
        this.editor = new Editor({
            extensions: [
                StarterKit,
                Document,
                Paragraph,
                Text,
                Image,
                Dropcursor,
                TextAlign.configure({
                    types: ["heading", "paragraph"],
                }),
                Highlight,
                Link.configure({
                    openOnClick: false,
                }),
                TextStyle,
                Color,
                CharacterCount.configure({
                    limit: this.limit,
                }),
                CodeBlockLowlight.configure({
                    lowlight,
                }),
                Placeholder.configure({
                    placeholder: "Write something ...",
                }),
                Table.configure({
                    resizable: true,
                }),
                TableRow,
                TableHeader,
                TableCell,
            ],
            content: "",
            enableInputRules: true,
            onUpdate: () => {
                // HTML
                this.$emit("input", this.editor.getHTML());

                // JSON
                // this.$emit('input', this.editor.getJSON())
            },
        });
    },

    watch: {
        modelValue(value) {
            // HTML
            const isSame = this.editor.getHTML() === value;

            // JSON
            // const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

            if (isSame) {
                return;
            }

            this.editor.commands.setContent(value, false);
        },
    },

    methods: {},

    beforeUnmount() {
        this.editor.destroy();
    },
};
</script>

<style>
.editor {
    display: flex;
    flex-direction: column;
    max-height: 26rem;
    color: #0d0d0d;
    background-color: #fff;
    border: 3px solid #0d0d0d;
    border-radius: 0.75rem;
}
.editor__header {
    display: flex;
    row-gap: 2px;
    align-items: center;
    flex: 0 0 auto;
    flex-wrap: wrap;
    padding: 0.25rem;
}
.customized-input {
    background-color: var(--white-color);
    border-radius: 20px;
    box-shadow: 0 3px 1px -2px rgb(0 0 0 / 20%), 0 2px 2px 0 rgb(0 0 0 / 14%),
        0 1px 5px 0 rgb(0 0 0 / 12%);
}
</style>
