<!DOCTYPE html>
<html>
<head>
    <title>View Task</title>

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

        .task-name {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .detail {
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .detail:last-child {
            border-bottom: none;
        }

        .label {
            font-size: 13px;
            color: #9ca3af;
            margin-bottom: 5px;
        }

        .value {
            font-size: 16px;
        }

        .completed {
            color: #22c55e;
            font-weight: bold;
        }

        .pending {
            color: #ef4444;
            font-weight: bold;
        }

        .actions {
            margin-top: 25px;
        }

        .edit-button {
            background: #dbeafe;
            color: #2563eb;
            padding: 10px 16px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
        }

        .edit-button:hover {
            background: #bfdbfe;
        }

        .back-button {
            margin-left: 12px;
            color: #6b7280;
            text-decoration: none;
        }

        .back-button:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Task Details</h1>
    </div>

    <div class="container">

        <div class="card">

            <h2 class="task-name">
                {{ $task->task_name }}
            </h2>

            <div class="detail">

                <div class="label">
                    Description
                </div>

                <div class="value">
                    {{ $task->description ?: 'No description provided.' }}
                </div>

            </div>

            <div class="detail">

                <div class="label">
                    Status
                </div>

                <div class="value">

                    @if ($task->status == 'Completed')

                        <span class="completed">
                            ✓ Completed
                        </span>

                    @else

                        <span class="pending">
                            ☐ Pending
                        </span>

                    @endif

                </div>

            </div>

            <div class="detail">

                <div class="label">
                    Due Date
                </div>

                <div class="value">
                    {{ $task->due_date ?: 'No due date' }}
                </div>

            </div>

            <div class="detail">

                <div class="label">
                    Created
                </div>

                <div class="value">
                    {{ $task->created_at->format('F d, Y h:i A') }}
                </div>

            </div>

            <div class="actions">

                <a
                    href="{{ route('tasks.edit', $task) }}"
                    class="edit-button"
                >
                    Edit Task
                </a>

                <a
                    href="{{ route('home') }}"
                    class="back-button"
                >
                    Back to Tasks
                </a>

            </div>

        </div>

    </div>

</body>
</html>