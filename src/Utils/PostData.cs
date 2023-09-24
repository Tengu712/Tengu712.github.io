using Ssg.Components;

namespace Ssg.Utils;

public class PostData
{
    public string Id { get; init; } = "";
    public string Title { get; init; } = "";
    public string[] Tags { get; init; } = new string[] { };
    public string Date { get; init; } = "";
    public IComponent? Content { get; init; } = null;
}
