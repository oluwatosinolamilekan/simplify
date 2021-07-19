<div class="w-full">
    @if($count > 0)
        <div x-data="manageTabs('{{ json_encode($tabshow) }}')" x-init="init()" x-cloak class="box">
            <div class="nav nav-tabs flex-col sm:flex-row justify-center lg:justify-start border-b border-gray-200">
                @foreach ($tabs as $id => $title )
                    <a @click="selectTab('{{ $id }}')" class="mt-5 px-4 pb-4 " :class="(tabs['{{ $id }}'] == true) ? ' active ' : '' ">
                        {{ $title }}
                    </a>
                @endforeach
            </div>
            <div class="mt-5 px-4 pb-4">
                @foreach ($tabs as $id => $tab)
                    <div x-show.transition.in.duration.300ms.opacity.50="tabs.{{ $id }}" class="">
                        {{ ${$id} ?? '' }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
<script>
    var manageTabs = (tabsfromphp) => {
        return {
            tabs: tabsfromphp,
            tabshow: [],
            init: function() {
                this.tabs = JSON.parse(this.tabs);
                var t = new URLSearchParams(window.location.search);
                t.has("tab") && this.selectTab(t.get("tab"))
            },
            selectTab: function(t) {
                var e = this;
                Object.keys(this.tabs).forEach((function(n) {
                    e.tabs[n] = t == n
                })),
                window.history.pushState("", "", "?tab=" + t)
            }
        }

    }

</script>
