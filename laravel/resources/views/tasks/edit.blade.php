<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            margin: 0;
            color: #374151;
        }

        .header {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 22px 40px;
        }

        .header h1 {
            max-width: 800px;
            margin: auto;
            font-size: 24px;
        }

        .container {
            max-width: 700px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        .update-button {
            background: #dbeafe;
            color: #2563eb;
            border: none;
            padding: 11px 18px;
            border-radius: 7px;
            font-weight: bold;
            cursor: pointer;
        }

        .update-button:hover {
            background: #bfdbfe;
        }

        .back-button {
            margin-left: 10px;
            color: #6b7280;
            text-decoration: none;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Edit Task</h1>
    </div>

    <div class="container">

        <div class="card">

            @if ($errors->any())

                <div class="error">

                    <strong>Please fix the following:</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif

            <form
                action="{{ route('tasks.update', $task) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="form-group">

                    <label for="task_name">
                        Task Name
                    </label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        value="{{ old('task_name', $task->task_name) }}"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                    >{{ old('description', $task->description) }}</textarea>

                </div>

                <div class="form-group">

                    <label for="status">
                        Status
                    </label>

                    <select id="status" name="status">

                        <option
                            value="Pending"
                            {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="Completed"
                            {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}
                        >
                            Completed
                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label for="due_date">
                        Due Date
                    </label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date', $task->due_date) }}"
                    >

                </div>

                <button
                    type="submit"
                    class="update-button"
                >
                    Update Task
                </button>

                <a
                    href="{{ route('home') }}"
                    class="back-button"
                >
                    Cancel
                </a>

            </form>

        </div>

    </div>

</body>
</html>