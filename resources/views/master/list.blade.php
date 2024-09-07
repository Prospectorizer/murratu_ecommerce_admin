<x-app-layout>
	@push('head')
	<!-- Scripts -->
	<script src="{{ asset('js/master.js')}}"></script>
	@endpush
    <x-slot name="header">
		<h1 class="text-white">Biriyani List</h1>
    </x-slot>
	<div class="text-white">
		<button id="master-ajax">Ajax</button>
		<table id="biriyani-list">
			<thead>
				<tr>
					<th>Name</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Biriyani</td>
				</tr>
			</tbody>
		</table>
	</div>
</x-app-layout>