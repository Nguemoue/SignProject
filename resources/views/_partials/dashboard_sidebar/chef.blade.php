<x-nav-link-component :icon="'mdi mdi-account'" :link="url('/user/profile')" :value="'Mon Compte'" class="mt-2 border"/>
<x-navlink-component  class="border mt-4" icon="mdi-account-multiple" :link="route('unite.index')">Mes Elements</x-navlink-component>
<x-nav-link-component :icon="'mdi mdi-mail'" :link="route('courier.index')" :value="'Services Courier'" class="mt-2 border"/>
<x-navlink-component class="border mt-1" link="{{ route('dashboard') }}" icon="mdi-account-eye">
    Garde a Vues
</x-navlink-component>
