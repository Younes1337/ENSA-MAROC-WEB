<template>
    <div>
        <v-row>
            <v-col
                cols="12"
                xs="12"
                sm="12"
                md="12"
                lg="12"
                xl="12"
                class="d-inline-flex"
                style="border-bottom: 1px solid var(--orange-color);"
            >
                <input
                    type="color"
                    @input="
                        editor
                            .chain()
                            .focus()
                            .setColor($event.target.value)
                            .run()
                    "
                    :value="editor.getAttributes('textStyle').color"
                />
                <template v-for="(item, index) in items">
                    <div
                        class="divider"
                        v-if="item.type === 'divider'"
                        :key="`divider${index}`"
                    />
                    <menu-item v-else :key="index" v-bind="item" />
                </template>
            </v-col>
            <v-col
                cols="12"
                xs="12"
                sm="12"
                md="12"
                lg="12"
                xl="12"
                class="d-inline-flex mb-4"
                style="border-bottom: 1px solid var(--orange-color);"
            >
                <template v-for="(table, index) in tables">
                    <div
                        class="divider"
                        v-if="table.type === 'divider'"
                        :key="`divider${index}`"
                    />
                    <menu-item v-else :key="index" v-bind="table" />
                </template>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import MenuItem from "./MenuItem.vue";

export default {
    components: {
        MenuItem,
    },

    props: {
        editor: {
            type: Object,
            required: true,
        },
    },

    methods: {
        setLink() {
            const previousUrl = this.editor.getAttributes("link").href;
            const url = window.prompt("URL", previousUrl);
            // cancelled
            if (url === null) {
                return;
            }
            // empty
            if (url === "") {
                this.editor
                    .chain()
                    .focus()
                    .extendMarkRange("link")
                    .unsetLink()
                    .run();
                return;
            }
            // update link
            this.editor
                .chain()
                .focus()
                .extendMarkRange("link")
                .setLink({ href: url })
                .run();
        },

        addImage() {
            const url = window.prompt("URL");

            if (url) {
                this.editor.chain().focus().setImage({ src: url }).run();
            }
        },
    },

    data() {
        return {
            tables: [
                {
                    icon: "table",
                    title: "Insert table",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .insertTable({
                                rows: 3,
                                cols: 3,
                                withHeaderRow: true,
                            })
                            .run(),
                },
                {
                    icon: "table-remove",
                    title: "Delete table",
                    action: () => this.editor.chain().focus().deleteTable().run(),
                },
                {
                    type: "divider",
                },
                {
                    icon: "table-column-plus-before",
                    title: "Add column before",
                    action: () => this.editor.chain().focus().addColumnBefore().run(),
                },
                {
                    icon: "table-column-plus-after",
                    title: "Add column after",
                    action: () => this.editor.chain().focus().addColumnAfter().run(),
                },
                {
                    icon: "table-column-remove",
                    title: "Delete column",
                    action: () => this.editor.chain().focus().deleteColumn().run(),
                },
                {
                    type: "divider",
                },
                {
                    icon: "table-row-plus-before",
                    title: "Add row before",
                    action: () => this.editor.chain().focus().addRowBefore().run(),
                },
                {
                    icon: "table-row-plus-after",
                    title: "Add row after",
                    action: () => this.editor.chain().focus().addRowAfter().run(),
                },
                {
                    icon: "table-row-remove",
                    title: "Delete row",
                    action: () => this.editor.chain().focus().deleteRow().run(),
                }
            ],
            items: [
                {
                    icon: "format-bold",
                    title: "Bold",
                    action: () =>
                        this.editor.chain().focus().toggleBold().run(),
                    isActive: () => this.editor.isActive("bold"),
                },
                {
                    icon: "format-italic",
                    title: "Italic",
                    action: () =>
                        this.editor.chain().focus().toggleItalic().run(),
                    isActive: () => this.editor.isActive("italic"),
                },
                {
                    icon: "format-strikethrough",
                    title: "Strike",
                    action: () =>
                        this.editor.chain().focus().toggleStrike().run(),
                    isActive: () => this.editor.isActive("strike"),
                },
                {
                    icon: "marker",
                    title: "Highlight",
                    action: () =>
                        this.editor.chain().focus().toggleHighlight().run(),
                    isActive: () => this.editor.isActive("highlight"),
                },
                {
                    type: "divider",
                },
                {
                    icon: "code-braces",
                    title: "Code",
                    action: () =>
                        this.editor.chain().focus().toggleCode().run(),
                    isActive: () => this.editor.isActive("code"),
                },
                {
                    icon: "code-braces-box",
                    title: "Code block low light",
                    action: () =>
                        this.editor.chain().focus().toggleCodeBlock().run(),
                    isActive: () => this.editor.isActive("codeBlock"),
                },
                {
                    type: "divider",
                },
                {
                    icon: "link-variant",
                    title: "Set link",
                    action: () => this.setLink(),
                    isActive: () => this.editor.isActive("link"),
                },
                {
                    icon: "link-variant-minus",
                    title: "Unset link",
                    action: () => this.editor.chain().focus().unsetLink().run(),
                    isDisabled: () => !this.editor.isActive("link"),
                },
                {
                    icon: "file-image-plus-outline",
                    title: "Add image",
                    action: () => this.addImage(),
                },
                {
                    type: "divider",
                },
                {
                    icon: "format-align-left",
                    title: "Align left",
                    action: () =>
                        this.editor.chain().focus().setTextAlign("left").run(),
                    isActive: () => this.editor.isActive({ textAlign: "left" }),
                },
                {
                    icon: "format-align-right",
                    title: "Align right",
                    action: () =>
                        this.editor.chain().focus().setTextAlign("right").run(),
                    isActive: () =>
                        this.editor.isActive({ textAlign: "right" }),
                },
                {
                    icon: "format-align-center",
                    title: "Align center",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .setTextAlign("center")
                            .run(),
                    isActive: () =>
                        this.editor.isActive({ textAlign: "center" }),
                },
                {
                    icon: "format-align-justify",
                    title: "Align justify",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .setTextAlign("justify")
                            .run(),
                    isActive: () =>
                        this.editor.isActive({ textAlign: "justify" }),
                },
                {
                    type: "divider",
                },
                {
                    icon: "format-header-1",
                    title: "Heading 1",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .toggleHeading({ level: 1 })
                            .run(),
                    isActive: () =>
                        this.editor.isActive("heading", { level: 1 }),
                },
                {
                    icon: "format-header-2",
                    title: "Heading 2",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .toggleHeading({ level: 2 })
                            .run(),
                    isActive: () =>
                        this.editor.isActive("heading", { level: 2 }),
                },
                {
                    icon: "format-header-3",
                    title: "Heading 3",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .toggleHeading({ level: 3 })
                            .run(),
                    isActive: () =>
                        this.editor.isActive("heading", { level: 3 }),
                },
                {
                    icon: "format-header-4",
                    title: "Heading 4",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .toggleHeading({ level: 4 })
                            .run(),
                    isActive: () =>
                        this.editor.isActive("heading", { level: 4 }),
                },
                {
                    icon: "format-header-5",
                    title: "Heading 5",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .toggleHeading({ level: 5 })
                            .run(),
                    isActive: () =>
                        this.editor.isActive("heading", { level: 5 }),
                },
                {
                    icon: "format-header-6",
                    title: "Heading 6",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .toggleHeading({ level: 6 })
                            .run(),
                    isActive: () =>
                        this.editor.isActive("heading", { level: 6 }),
                },
                {
                    icon: "format-paragraph",
                    title: "Paragraph",
                    action: () =>
                        this.editor.chain().focus().setParagraph().run(),
                    isActive: () => this.editor.isActive("paragraph"),
                },
                {
                    icon: "format-list-bulleted",
                    title: "Bullet List",
                    action: () =>
                        this.editor.chain().focus().toggleBulletList().run(),
                    isActive: () => this.editor.isActive("bulletList"),
                },
                {
                    icon: "format-list-numbered",
                    title: "Ordered List",
                    action: () =>
                        this.editor.chain().focus().toggleOrderedList().run(),
                    isActive: () => this.editor.isActive("orderedList"),
                },
                {
                    type: "divider",
                },
                {
                    icon: "format-quote-open",
                    title: "Blockquote",
                    action: () =>
                        this.editor.chain().focus().toggleBlockquote().run(),
                    isActive: () => this.editor.isActive("blockquote"),
                },
                {
                    icon: "minus",
                    title: "Horizontal Rule",
                    action: () =>
                        this.editor.chain().focus().setHorizontalRule().run(),
                },
                {
                    type: "divider",
                },
                {
                    icon: "wrap",
                    title: "Hard Break",
                    action: () =>
                        this.editor.chain().focus().setHardBreak().run(),
                },
                {
                    icon: "format-clear",
                    title: "Clear Format",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .clearNodes()
                            .unsetAllMarks()
                            .run(),
                },
                {
                    type: "divider",
                },
                {
                    icon: "arrow-u-left-top",
                    title: "Undo",
                    action: () => this.editor.chain().focus().undo().run(),
                },
                {
                    icon: "arrow-u-right-top",
                    title: "Redo",
                    action: () => this.editor.chain().focus().redo().run(),
                },
            ],
        };
    },
};
</script>

<style>
.divider {
    width: 2px;
    height: 1.25rem;
    background-color: var(--black-color);
    margin-left: 0.5rem;
    margin-right: 0.75rem;
}
</style>
