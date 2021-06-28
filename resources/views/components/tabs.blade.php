@props(['active'])

<div x-data="{
        activeTab: '{{ $active }}',
        tabs: [],
        tabHeadings: [],
        toggleTabs() {
            this.tabs.forEach(
                tab => tab.__x.$data.showIfActive(this.activeTab)
            );
        }
     }"
     x-init="() => {
        tabs = [...$refs.tabs.children];
        tabHeadings = tabs.map((tab, index) => {
            tab.__x.$data.id = (index + 1);
            return tab.__x.$data.name;
        });
        toggleTabs();
     }"
     class="box"
>
    <div class="nav nav-tabs flex-col sm:flex-row justify-center lg:justify-start border-b border-gray-200"
         role="tablist"
    >
        <template x-for="(tab, index) in tabHeadings"
                  :key="index"
        >
            <a
               x-text="tab"
               href="javascript:;"
               @click="activeTab = tab; toggleTabs();"
               class="py-4 px-6"
               :class="tab === activeTab ? 'active' : ''"
               :id="`tab-${index + 1}`"
               role="tab"
               :aria-selected="(tab === activeTab).toString()"
               :aria-controls="`tab-panel-${index + 1}`"
            >Dashboard</a>
        </template>
    </div>

    <div x-ref="tabs">
        {{ $slot }}
    </div>
</div>
