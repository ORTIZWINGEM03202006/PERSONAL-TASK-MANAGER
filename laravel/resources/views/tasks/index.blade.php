<!DOCTYPE html>
<html>
<head>
    <title>Personal Task Manager</title>

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

        .header-content {
            max-width: 1000px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #374151;
        }

        .header p {
            margin: 6px 0 0;
            color: #9ca3af;
        }

        .add-button {
            background: #dbeafe;
            color: #2563eb;
            padding: 11px 18px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .add-button:hover {
            background: #bfdbfe;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .summary {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .summary-box {
            background: #ffffff;
            padding: 18px;
            border-radius: 10px;
            flex: 1;
            border: 1px solid #e5e7eb;
        }

        .summary-box h3 {
            margin: 0 0 8px;
            font-size: 14px;
            color: #9ca3af;
        }

        .summary-box p {
            margin: 0;
            font-size: 25px;
            font-weight: bold;
        }

        .total {
            color: #6b7280;
        }

        .pending {
            color: #ef4444;
        }

        .completed {
            color: #22c55e;
        }

        .tasks-title {
            margin-bottom: 15px;
            color: #374151;
        }

        .task {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .task-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-name {
            font-size: 18px;
            font-weight: bold;
            color: #374151;
        }

        .status {
            font-weight: bold;
        }

        .task-description {
            color: #6b7280;
            margin: 10px 0;
        }

        .due-date {
            font-size: 14px;
            color: #9ca3af;
        }

        .task-actions {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f1f5f9;
        }

        .task-actions a {
            margin-right: 15px;
            color: #3b82f6;
            text-decoration: none;
        }

        .task-actions a:hover {
            text-decoration: underline;
        }

        .delete-button {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            padding: 7px 12px;
            border-radius: 6px;
            cursor: pointer;
        }

        .delete-button:hover {
            background: #fecaca;
        }

        .status-form {
            display: inline;
        }

        .status-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
            vertical-align: middle;
            margin-right: 5px;
        }

        .empty {
            background: #ffffff;
            padding: 40px;
            text-align: center;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            color: #9ca3af;
        }

        @media (max-width: 600px) {

            .header {
                padding: 20px;
            }

            .header-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .summary {
                flex-direction: column;
            }

            .task-top {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="header">

        <div class="header-content">

            <div>
                <h1>Personal Task Manager</h1>
                <p>Organize your tasks and track your progress.</p>
            </div>

            <a href="{{ route('tasks.create') }}" class="add-button">
                + Add Task
            </a>

        </div>

    </div>


    <div class="container">

        @php
            $totalTasks = $tasks->count();
            $completedTasks = $tasks->where('status', 'Completed')->count();
            $pendingTasks = $tasks->where('status', 'Pending')->count();
        @endphp


        <div class="summary">

            <div class="summary-box">
                <h3>Total Tasks</h3>
                <p class="total">{{ $totalTasks }}</p>
            </div>

            <div class="summary-box">
                <h3>Pending</h3>
                <p class="pending">{{ $pendingTasks }}</p>
            </div>

            <div class="summary-box">
                <h3>Completed</h3>
                <p class="completed">{{ $completedTasks }}</p>
            </div>

        </div>


        <h2 class="tasks-title">My Tasks</h2>


        @if ($tasks->count() > 0)

            @foreach ($tasks as $task)

                <div class="task">

                    <div class="task-top">

                        <div class="task-name">
                            {{ $task->task_name }}
                        </div>


                        <form
                            action="{{ route('tasks.update', $task) }}"
                            method="POST"
                            class="status-form"
                        >

                            @csrf
                            @method('PUT')

                            <input
                                type="hidden"
                                name="task_name"
                                value="{{ $task->task_name }}"
                            >

                            <input
                                type="hidden"
                                name="description"
                                value="{{ $task->description }}"
                            >

                            <input
                                type="hidden"
                                name="due_date"
                                value="{{ $task->due_date }}"
                            >

                            <input
                                type="hidden"
                                name="status"
                                value="{{ $task->status == 'Completed' ? 'Pending' : 'Completed' }}"
                            >

                            <input
                                type="checkbox"
                                class="status-checkbox"
                                onchange="this.form.submit()"
                                {{ $task->status == 'Completed' ? 'checked' : '' }}
                            >

                            @if ($task->status == 'Completed')

                                <span class="status completed">
                                    Completed
                                </span>

                            @else

                                <span class="status pending">
                                    Pending
                                </span>

                            @endif

                        </form>

                    </div>


                    <div class="task-description">
                        {{ $task->description ?: 'No description provided.' }}
                    </div>


                    <div class="due-date">
                        Due: {{ $task->due_date ?: 'No due date' }}
                    </div>


                    <div class="task-actions">

                        <a href="{{ route('tasks.show', $task) }}">
                            View
                        </a>

                        <a href="{{ route('tasks.edit', $task) }}">
                            Edit
                        </a>


                        <form
                            action="{{ route('tasks.destroy', $task) }}"
                            method="POST"
                            style="display: inline;"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete-button"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        @else

            <div class="empty">

                <h3>No tasks yet</h3>

                <p>Start by adding your first task.</p>

                <a
                    href="{{ route('tasks.create') }}"
                    class="add-button"
                >
                    + Add Your First Task
                </a>

            </div>

        @endif

    </div>

</body>
</html>