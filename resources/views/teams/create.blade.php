<x-layouts::app :title="__('Add Team')">
    <div class="max-w-2xl flex flex-col gap-6">

        <div class="flex items-center gap-3">
            <a href="{{ route('teams.index') }}">
                <flux:button size="sm" icon="arrow-left" variant="ghost">Back</flux:button>
            </a>
            <h1 class="text-xl font-semibold">Add Team / Subcon</h1>
        </div>

        <form method="POST" action="{{ route('teams.store') }}" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf

            <flux:field>
                <flux:label>Team Name <flux:required /></flux:label>
                <flux:input name="team_name" value="{{ old('team_name') }}" placeholder="e.g. Alpha Team" />
                @error('team_name') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Email</flux:label>
                <flux:input type="email" name="team_email" value="{{ old('team_email') }}" placeholder="team@example.com" />
                @error('team_email') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Contact Number</flux:label>
                <flux:input name="contact_number" value="{{ old('contact_number') }}" placeholder="09XXXXXXXXX" />
                @error('contact_number') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Address</flux:label>
                <flux:textarea name="address" placeholder="Full address..." rows="3">{{ old('address') }}</flux:textarea>
                @error('address') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Logo</flux:label>
                <flux:input type="file" name="logo" accept="image/*" />
                @error('logo') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Status</flux:label>
                <flux:select name="status">
                    <flux:select.option value="active" :selected="old('status', 'active') === 'active'">Active</flux:select.option>
                    <flux:select.option value="inactive" :selected="old('status') === 'inactive'">Inactive</flux:select.option>
                </flux:select>
                @error('status') <flux:error>{{ $message }}</flux:error> @enderror
            </flux:field>

            <div class="flex gap-3 pt-2">
                <flux:button type="submit" variant="primary">Save Team</flux:button>
                <a href="{{ route('teams.index') }}">
                    <flux:button variant="ghost">Cancel</flux:button>
                </a>
            </div>
        </form>
    </div>
</x-layouts::app>
