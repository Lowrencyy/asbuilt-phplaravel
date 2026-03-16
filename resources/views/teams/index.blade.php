<x-layouts::app :title="__('Teams')">
    <div class="flex flex-col gap-6">

        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Teams / Subcon</h1>
            <a href="{{ route('teams.create') }}">
                <flux:button variant="primary">+ Add Team</flux:button>
            </a>
        </div>

        @if(session('success'))
            <flux:callout variant="success" icon="check-circle">
                <flux:callout.text>{{ session('success') }}</flux:callout.text>
            </flux:callout>
        @endif

        <flux:table>
            <flux:table.head>
                <flux:table.row>
                    <flux:table.cell heading>Logo</flux:table.cell>
                    <flux:table.cell heading>Team Name</flux:table.cell>
                    <flux:table.cell heading>Email</flux:table.cell>
                    <flux:table.cell heading>Contact</flux:table.cell>
                    <flux:table.cell heading>Address</flux:table.cell>
                    <flux:table.cell heading>Status</flux:table.cell>
                    <flux:table.cell heading>Actions</flux:table.cell>
                </flux:table.row>
            </flux:table.head>
            <flux:table.body>
                @forelse($teams as $team)
                    <flux:table.row>
                        <flux:table.cell>
                            @if($team->logo)
                                <img src="{{ asset('storage/' . $team->logo) }}" class="h-10 w-10 rounded-full object-cover" />
                            @else
                                <div class="h-10 w-10 rounded-full bg-neutral-200 dark:bg-neutral-700 flex items-center justify-center text-xs text-neutral-500">
                                    N/A
                                </div>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell class="font-medium">{{ $team->team_name }}</flux:table.cell>
                        <flux:table.cell>{{ $team->team_email ?? '—' }}</flux:table.cell>
                        <flux:table.cell>{{ $team->contact_number ?? '—' }}</flux:table.cell>
                        <flux:table.cell>{{ $team->address ?? '—' }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge variant="{{ $team->status === 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($team->status) }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex gap-2">
                                <a href="{{ route('teams.edit', $team) }}">
                                    <flux:button size="sm">Edit</flux:button>
                                </a>
                                <form method="POST" action="{{ route('teams.destroy', $team) }}" onsubmit="return confirm('Delete this team?')">
                                    @csrf @method('DELETE')
                                    <flux:button size="sm" variant="danger" type="submit">Delete</flux:button>
                                </form>
                            </div>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="7" class="text-center text-neutral-400">No teams found.</flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.body>
        </flux:table>

        <div>{{ $teams->links() }}</div>
    </div>
</x-layouts::app>
