<x-layouts::app :title="__('Edit Team')">
    <div class="max-w-2xl flex flex-col gap-6">

        <div class="flex items-center gap-3">
            <a href="{{ route('teams.index') }}">
                <flux:button size="sm" icon="arrow-left" variant="ghost">Back</flux:button>
            </a>
            <h1 class="text-xl font-semibold">Edit Team: {{ $team->team_name }}</h1>
        </div>

        <form method="POST" action="{{ route('teams.update', $team) }}" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf @method('PUT')

            <flux:field>
                <flux:label>Team Name <flux:required /></flux:label>
                <flux:input name="team_name" value="{{ old('team_name', $team->team_name) }}" />
                @error('team_name') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Email</flux:label>
                <flux:input type="email" name="team_email" value="{{ old('team_email', $team->team_email) }}" />
                @error('team_email') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Contact Number</flux:label>
                <flux:input name="contact_number" value="{{ old('contact_number', $team->contact_number) }}" />
                @error('contact_number') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Address</flux:label>
                <flux:textarea name="address" rows="3">{{ old('address', $team->address) }}</flux:textarea>
                @error('address') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Logo</flux:label>
                @if($team->logo)
                    <img src="{{ asset('storage/' . $team->logo) }}" class="h-16 w-16 rounded-full object-cover mb-2" />
                @endif
                <flux:input type="file" name="logo" accept="image/*" />
                <flux:description>Leave empty to keep current logo.</flux:description>
                @error('logo') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Status</flux:label>
                <flux:select name="status">
                    <flux:select.option value="active" :selected="old('status', $team->status) === 'active'">Active</flux:select.option>
                    <flux:select.option value="inactive" :selected="old('status', $team->status) === 'inactive'">Inactive</flux:select.option>
                </flux:select>
                @error('status') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <div class="flex gap-3 pt-2">
                <flux:button type="submit" variant="primary">Update Team</flux:button>
                <a href="{{ route('teams.index') }}">
                    <flux:button variant="ghost">Cancel</flux:button>
                </a>
            </div>
        </form>
    </div>
</x-layouts::app>
