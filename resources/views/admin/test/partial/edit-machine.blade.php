
                       
                                <select name="machine_ids[]" id="machine_ids" class="form-control select2" multiple>
                                    @foreach ($machines as $machine)
                                        <option value="{{ $machine->id }}"
                                            @if (
                                                (old('machine_ids') && in_array($machine->id, old('machine_ids'))) ||
                                                    (!old('machine_ids') && $test->machines->contains($machine->id))) selected @endif>
                                            {{ $machine->name }}
                                        </option>
                                    @endforeach
                                </select>
