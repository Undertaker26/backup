<center><h4>
    BOARD OF REGENTS
</h4></center>
<ul class="org-chart">
    @foreach ($organizations as $organization)
        <li>
            <div class="org-node">
                @if ($organization->image)
                    <img src="{{ asset('storage/' . $organization->image) }}" alt="{{ $organization->name }}" class="org-image">
                @endif
                <div class="org-info">
                    <strong class="org-name">{{ $organization->name }}</strong>
                    <span class="org-position">{{ $organization->position }}</span>
                </div>
            </div>
            @if ($organization->children->isNotEmpty())
                <ul>
                    @include('admin.organ_chart.tree', ['organizations' => $organization->children])
                </ul>
            @endif
        </li>
    @endforeach
</ul>

<style>
    /* Container for the organizational chart */
.org-chart {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Styles for each list item */
.org-chart > li {
    position: relative;
    padding: 20px 0;
    margin-left: 20px;
    text-align: center;
}

/* Connects the nodes vertically */
.org-chart > li::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    height: 100%;
    width: 2px;
    background: #000;
    z-index: -1;
}

/* Connects the nodes horizontally */
.org-chart > li::after {
    content: '';
    position: absolute;
    top: 20px;
    left: 50%;
    width: 20px;
    height: 2px;
    background: #000;
    z-index: -1;
}

/* Container for aligning nodes horizontally */
.org-node-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px; /* Space between nodes */
}

/* Style for each organizational node */
.org-node {
    display: inline-block;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-align: center;
}

/* Style for images within the nodes */
.org-image {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-bottom: 10px;
}

/* Style for the name and position text */
.org-info {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.org-name {
    font-weight: bold;
    margin-bottom: 5px;
}

.org-position {
    color: #666;
}

/* Style for nested lists */
.org-chart ul {
    padding-left: 0;
    margin-top: 10px;
}

/* Specific styles for horizontal alignment of top-level nodes */
.org-chart > li.top-level {
    display: flex;
    justify-content: center;
}

.org-chart > li.top-level > ul {
    display: flex;
    gap: 20px;
}

</style>